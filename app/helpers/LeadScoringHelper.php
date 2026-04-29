<?php

class LeadScoringHelper {
    public static function scoreAccount(array $data): array {
        $score = 0;
        $reasons = [];

        $email = (string) ($data['email'] ?? '');
        $phone = preg_replace('/\D+/', '', (string) ($data['phone'] ?? ''));
        $name = trim((string) ($data['full_name'] ?? ''));
        $status = (string) ($data['status'] ?? 'new');

        if ($name !== '') {
            $score += 15;
            $reasons[] = 'Full name provided';
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $score += 20;
            $reasons[] = 'Valid email provided';
        }
        if (strlen($phone) >= 10) {
            $score += 20;
            $reasons[] = 'Reachable phone provided';
        }
        if (!empty($data['occupation'])) {
            $score += 15;
            $reasons[] = 'Occupation captured';
        }
        if (!empty($data['address'])) {
            $score += 10;
            $reasons[] = 'Address provided';
        }
        if ($status === 'new') {
            $score += 10;
            $reasons[] = 'Fresh unworked lead';
        }

        $priority = self::priorityFromScore($score);
        return ['score' => min(100, $score), 'priority' => $priority, 'reasons' => $reasons];
    }

    public static function scoreLoan(array $data): array {
        $score = 0;
        $reasons = [];

        $amount = (float) ($data['amount'] ?? 0);
        $duration = (int) ($data['duration'] ?? 0);
        $status = (string) ($data['status'] ?? 'new');
        $docs = self::countDocuments($data['documents'] ?? '');

        if (in_array((string) ($data['loan_type'] ?? ''), ['personal', 'auto', 'mortgage'], true)) {
            $score += 10;
            $reasons[] = 'Known loan product selected';
        }
        if ($amount >= 50000) {
            $score += 20;
            $reasons[] = 'Valid requested amount';
        }
        if ($duration >= 12 && $duration <= 48) {
            $score += 10;
            $reasons[] = 'Reasonable repayment duration';
        }
        if (!empty($data['employment_status'])) {
            $score += 15;
            $reasons[] = 'Employment status provided';
        }
        if ((float) ($data['monthly_income'] ?? 0) > 0) {
            $score += 10;
            $reasons[] = 'Income declared';
        }
        if ($docs >= 2) {
            $score += 25;
            $reasons[] = 'Both required documents uploaded';
        } elseif ($docs === 1) {
            $score += 10;
            $reasons[] = 'One supporting document uploaded';
        }
        if ($status === 'new') {
            $score += 10;
            $reasons[] = 'Fresh unworked lead';
        }

        $priority = self::priorityFromScore($score);
        return ['score' => min(100, $score), 'priority' => $priority, 'reasons' => $reasons];
    }

    private static function countDocuments(string $json): int {
        if ($json === '') {
            return 0;
        }
        $data = json_decode($json, true);
        if (!is_array($data)) {
            return 0;
        }
        $count = 0;
        foreach (['payslip', 'id_document'] as $key) {
            if (!empty($data[$key])) {
                $count++;
            }
        }
        return $count;
    }

    private static function priorityFromScore(int $score): string {
        if ($score >= 70) {
            return 'high';
        }
        if ($score >= 45) {
            return 'medium';
        }
        return 'low';
    }
}
