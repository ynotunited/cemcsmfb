<?php
if (defined('APP_ROOT') && file_exists(APP_ROOT . '/app/models/FaqEntry.php')) {
    require_once APP_ROOT . '/app/models/FaqEntry.php';
}

class ChatbotHelper {
    private const STOP_WORDS = [
        'a', 'an', 'and', 'are', 'as', 'at', 'be', 'by', 'for', 'from', 'has', 'have',
        'how', 'i', 'in', 'is', 'it', 'me', 'my', 'of', 'on', 'or', 'our', 'please',
        'the', 'to', 'we', 'what', 'when', 'where', 'which', 'who', 'with', 'you', 'your',
        'this', 'that', 'tell', 'about', 'into', 'more', 'info', 'information', 'year'
    ];

    public static function answer(string $question): array {
        $question = trim($question);
        $intent = self::detectIntent($question);
        $prefillUrl = self::prefillUrlForIntent($intent, $question);
        if ($question === '') {
            return [
                'answered' => false,
                'answer' => 'Please type your question so I can help.',
                'intent' => $intent,
                'prefill_url' => $prefillUrl,
            ];
        }

        $quick = self::quickIntentAnswer($question);
        if ($quick !== null) {
            return [
                'answered' => true,
                'answer' => $quick,
                'source_title' => 'Support Information',
                'source_url' => APP_URL . '/contact',
                'intent' => $intent,
                'prefill_url' => $prefillUrl,
            ];
        }

        $kb = self::buildKnowledgeBase();
        $tokens = self::tokenize($question);

        if (empty($tokens)) {
            return [
                'answered' => false,
                'answer' => 'I could not understand that yet. Please rephrase your question.',
                'intent' => $intent,
                'prefill_url' => $prefillUrl,
            ];
        }

        $best = null;
        foreach ($kb as $doc) {
            $analysis = self::analyzeDocument($doc, $tokens, $question);
            if ($best === null || $analysis['score'] > $best['score']) {
                $best = [
                    'score' => $analysis['score'],
                    'matched' => $analysis['matched'],
                    'doc' => $doc,
                ];
            }
        }

        if ($best === null || $best['score'] < 4 || $best['matched'] < 2) {
            return [
                'answered' => false,
                'answer' => 'I am not fully sure about that yet.',
                'intent' => $intent,
                'prefill_url' => $prefillUrl,
            ];
        }

        $snippet = self::buildSnippet($best['doc']['text'], $tokens);
        $answer = $snippet !== ''
            ? $snippet
            : 'I found related information on this page.';

        return [
            'answered' => true,
            'answer' => $answer,
            'source_title' => $best['doc']['title'],
            'source_url' => APP_URL . $best['doc']['route'],
            'intent' => $intent,
            'prefill_url' => $prefillUrl,
        ];
    }

    public static function whatsappLink(string $message = ''): string {
        $number = defined('WHATSAPP_SUPPORT_NUMBER') ? WHATSAPP_SUPPORT_NUMBER : '2348087995012';
        $number = preg_replace('/\D+/', '', $number);
        $prefill = trim($message) !== ''
            ? $message
            : 'Hello, I need help with information on the CEMCS MFB website.';
        return 'https://wa.me/' . $number . '?text=' . urlencode($prefill);
    }

    private static function quickIntentAnswer(string $question): ?string {
        $q = strtolower($question);
        if (preg_match('/\b(hello|hi|hey)\b/', $q)) {
            return 'Hi. I can help with account opening, loans, forms, careers, branch details, and contact information.';
        }
        if (preg_match('/\b(phone|call|contact number)\b/', $q)) {
            return 'You can call CEMCS MFB on +234 808 799 5012. You can also use the contact page for more options.';
        }
        if (preg_match('/\b(email|mail)\b/', $q)) {
            return 'Support email is helpdesk@cemcsmfb.com and general enquiries can go to info@cemcsmfb.com.';
        }
        if (preg_match('/\b(address|location|branch|office)\b/', $q)) {
            return 'Head Office: 6, Udeco Medical Road, Chevyview Estate, Off Chevron Drive, Lekki, Lagos.';
        }
        return null;
    }

    private static function buildKnowledgeBase(): array {
        static $kb = null;
        if ($kb !== null) {
            return $kb;
        }

        $methodToView = self::parseControllerMethods();
        $routes = self::parsePageRoutes();
        $kb = [];

        foreach ($routes as $route) {
            $method = $route['method'];
            if (!isset($methodToView[$method])) {
                continue;
            }

            $viewInfo = $methodToView[$method];
            $viewPath = APP_ROOT . '/app/views/' . $viewInfo['view'] . '.php';
            if (!file_exists($viewPath)) {
                continue;
            }

            $raw = file_get_contents($viewPath);
            if ($raw === false) {
                continue;
            }

            $text = self::extractVisibleText($raw);
            if ($text === '') {
                continue;
            }

            $title = $viewInfo['title'] ?: self::titleFromRoute($route['path']);
            $kb[] = [
                'route' => $route['path'],
                'title' => $title,
                'text' => $text,
                'tokens' => self::tokenize($title . ' ' . $text),
            ];
        }

        if (class_exists('FaqEntry')) {
            $faqRows = FaqEntry::published(200);
            foreach ($faqRows as $faq) {
                $title = trim((string) ($faq['question'] ?? 'FAQ'));
                $text = trim((string) ($faq['answer_text'] ?? ''));
                if ($text === '') {
                    continue;
                }
                $kb[] = [
                    'route' => '/help',
                    'title' => $title,
                    'text' => $text,
                    'tokens' => self::tokenize($title . ' ' . $text),
                ];
            }
        }

        return $kb;
    }

    private static function parseControllerMethods(): array {
        $file = APP_ROOT . '/app/controllers/PageController.php';
        $content = file_exists($file) ? file_get_contents($file) : '';
        if ($content === false || $content === '') {
            return [];
        }

        $pattern = '/public function\s+(\w+)\s*\(\)\s*\{\s*return\s+\$this->view\(\'([^\']+)\'\s*,\s*\[(.*?)\]\);/s';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $map = [];
        foreach ($matches as $match) {
            $method = $match[1];
            $view = $match[2];
            $args = $match[3];
            $title = '';
            if (preg_match("/'title'\\s*=>\\s*'([^']+)'/", $args, $t)) {
                $title = $t[1];
            }
            $map[$method] = [
                'view' => $view,
                'title' => $title,
            ];
        }

        return $map;
    }

    private static function parsePageRoutes(): array {
        $file = APP_ROOT . '/app/routes.php';
        $content = file_exists($file) ? file_get_contents($file) : '';
        if ($content === false || $content === '') {
            return [];
        }

        preg_match_all(
            '/\$router->get\(\'([^\']+)\'\s*,\s*\[PageController::class\s*,\s*\'([^\']+)\'\]\);/',
            $content,
            $matches,
            PREG_SET_ORDER
        );

        $routes = [];
        foreach ($matches as $match) {
            $routes[] = [
                'path' => $match[1],
                'method' => $match[2],
            ];
        }
        return $routes;
    }

    private static function extractVisibleText(string $raw): string {
        $noScripts = preg_replace('/<(script|style)\\b[^>]*>[\\s\\S]*?<\\/\\1>/i', ' ', $raw);
        $noPhp = preg_replace('/<\\?(?:php|=)[\\s\\S]*?\\?>/i', ' ', (string) $noScripts);
        $stripped = strip_tags((string) $noPhp);
        $decoded = html_entity_decode($stripped, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $normalized = preg_replace('/\\s+/', ' ', $decoded);
        return trim((string) $normalized);
    }

    private static function tokenize(string $text): array {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\\s]/', ' ', $text);
        $parts = preg_split('/\\s+/', (string) $text, -1, PREG_SPLIT_NO_EMPTY);
        $tokens = [];
        foreach ($parts as $part) {
            if (strlen($part) < 3) {
                continue;
            }
            if (in_array($part, self::STOP_WORDS, true)) {
                continue;
            }
            $tokens[] = $part;
        }
        return array_values(array_unique($tokens));
    }

    private static function analyzeDocument(array $doc, array $queryTokens, string $question): array {
        $score = 0;
        $matched = 0;
        $docTokens = $doc['tokens'];
        $docTextLower = strtolower($doc['text']);
        $titleLower = strtolower($doc['title']);

        foreach ($queryTokens as $token) {
            $tokenMatched = false;
            if (in_array($token, $docTokens, true)) {
                $score += 2;
                $tokenMatched = true;
            }
            if (strpos($titleLower, $token) !== false) {
                $score += 2;
                $tokenMatched = true;
            }
            if (strpos($docTextLower, $token) !== false) {
                $score += 1;
                $tokenMatched = true;
            }
            if ($tokenMatched) {
                $matched++;
            }
        }

        $questionLower = strtolower(trim($question));
        if (strlen($questionLower) > 12 && strpos($docTextLower, $questionLower) !== false) {
            $score += 4;
        }

        return [
            'score' => $score,
            'matched' => $matched,
        ];
    }

    private static function buildSnippet(string $text, array $tokens): string {
        if ($text === '') {
            return '';
        }
        $lower = strtolower($text);
        $bestPos = null;
        foreach ($tokens as $token) {
            $pos = strpos($lower, $token);
            if ($pos !== false && ($bestPos === null || $pos < $bestPos)) {
                $bestPos = $pos;
            }
        }
        if ($bestPos === null) {
            return mb_substr($text, 0, 280) . '...';
        }
        $start = max(0, $bestPos - 80);
        $snippet = trim(mb_substr($text, $start, 320));
        return $snippet . '...';
    }

    private static function titleFromRoute(string $route): string {
        if ($route === '/') {
            return 'Home';
        }
        $slug = trim($route, '/');
        $slug = str_replace('-', ' ', $slug);
        return ucwords($slug);
    }

    private static function detectIntent(string $question): string {
        $q = strtolower($question);
        if (preg_match('/\b(open account|account opening|new account|bvn)\b/', $q)) {
            return 'open_account';
        }
        if (preg_match('/\b(loan|borrow|credit|repayment|interest)\b/', $q)) {
            return 'loan';
        }
        if (preg_match('/\b(job|career|vacancy|cv|resume)\b/', $q)) {
            return 'career';
        }
        if (preg_match('/\b(contact|complaint|support|help|branch|address)\b/', $q)) {
            return 'support';
        }
        if (preg_match('/\b(form|download)\b/', $q)) {
            return 'forms';
        }
        return 'general';
    }

    private static function prefillUrlForIntent(string $intent, string $question): string {
        $q = urlencode(trim($question));
        if ($intent === 'open_account') {
            return APP_URL . '/open-account?intent=open_account&source=chatbot&q=' . $q;
        }
        if ($intent === 'loan') {
            return APP_URL . '/loans?intent=loan&source=chatbot&q=' . $q;
        }
        if ($intent === 'career') {
            return APP_URL . '/careers?intent=career&source=chatbot&q=' . $q;
        }
        if ($intent === 'forms') {
            return APP_URL . '/forms?intent=forms&source=chatbot&q=' . $q;
        }
        if ($intent === 'support') {
            return APP_URL . '/contact?intent=support&source=chatbot&q=' . $q;
        }
        return '';
    }
}
