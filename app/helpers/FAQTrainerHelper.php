<?php
require_once APP_ROOT . '/app/helpers/ChatbotHelper.php';
require_once APP_ROOT . '/app/models/ChatbotInteraction.php';
require_once APP_ROOT . '/app/models/FaqEntry.php';

class FAQTrainerHelper {
    public static function generateDrafts(int $limit = 10): int {
        $questions = ChatbotInteraction::topUnresolvedQuestions($limit);
        $created = 0;

        foreach ($questions as $row) {
            $question = trim((string) ($row['question'] ?? ''));
            if ($question === '') {
                continue;
            }

            $suggestion = ChatbotHelper::answer($question);
            $answer = (string) ($suggestion['answer'] ?? '');
            if ($answer === '') {
                $answer = 'Suggested answer: please review and complete this response before publishing.';
            }
            $source = (string) ($suggestion['source_url'] ?? '');

            FaqEntry::createDraft($question, $answer, $source);
            $created++;
        }

        return $created;
    }
}
