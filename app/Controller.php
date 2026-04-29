<?php
require_once APP_ROOT . '/app/helpers/CsrfHelper.php';
require_once APP_ROOT . '/app/helpers/Mailer.php';
require_once APP_ROOT . '/app/helpers/ReCaptcha.php';

class Controller {

    /**
     * Render a view wrapped in a layout.
     *
     * $data keys are extracted as variables inside the view.
     * 'csrf_token' and 'recaptcha_site_key' are always injected.
     */
    public function view(string $view, array $data = []): void {
        // Ensure session is started so CSRF token can be generated
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Always make CSRF token and reCAPTCHA site key available in views
        $data['csrf_token']          = CsrfHelper::token();
        $data['recaptcha_site_key']  = defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '';

        extract($data);

        $viewFile = APP_ROOT . '/app/views/' . $view . '.php';

        if (strpos($view, 'pages/') === 0) {
            require_once APP_ROOT . '/app/models/ManagedPage.php';
            $slug = ManagedPage::slugForView($view);

            if ($slug) {
                $managedPage = ManagedPage::findPublished($slug);

                if ($managedPage) {
                    $title = $managedPage['title'] ?? ($data['title'] ?? '');
                    $meta_description = $managedPage['meta_description'] ?? ($data['meta_description'] ?? '');
                    $managed_content = $managedPage['content'] ?? '';

                    ob_start();
                    require_once APP_ROOT . '/app/views/pages/managed.php';
                    $content = ob_get_clean();

                    $layout = $data['layout'] ?? 'layout';
                    require_once APP_ROOT . '/app/views/' . $layout . '.php';
                    return;
                }
            }
        }

        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();

            $layout = $data['layout'] ?? 'layout';
            require_once APP_ROOT . '/app/views/' . $layout . '.php';
        } else {
            die("Error: View '$view' not found.");
        }
    }
}
