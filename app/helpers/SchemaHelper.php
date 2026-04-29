<?php

class SchemaHelper {
    private static bool $initialized = false;

    public static function ensureCoreTables(PDO $pdo): void {
        if (self::$initialized) {
            return;
        }
        self::$initialized = true;

        $statements = [
            "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                role ENUM('admin', 'staff') DEFAULT 'staff',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS account_applications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                account_type VARCHAR(100) NOT NULL,
                full_name VARCHAR(255) NOT NULL,
                dob DATE NOT NULL,
                phone VARCHAR(50) NOT NULL,
                email VARCHAR(255) NOT NULL,
                address TEXT NOT NULL,
                occupation VARCHAR(255) NOT NULL,
                id_document VARCHAR(255),
                passport_photo VARCHAR(255),
                utility_bill VARCHAR(255),
                status ENUM('new', 'contacted', 'approved', 'rejected') DEFAULT 'new',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS loan_applications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                loan_type VARCHAR(100) NOT NULL,
                amount DECIMAL(15,2) NOT NULL,
                duration INT NOT NULL COMMENT 'duration in months',
                employment_status VARCHAR(100) NOT NULL,
                monthly_income DECIMAL(15,2) NOT NULL,
                business_name VARCHAR(255),
                documents TEXT COMMENT 'JSON array of uploaded document paths',
                status ENUM('new', 'review', 'approved', 'rejected') DEFAULT 'new',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS contact_messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(50),
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS complaints (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(50),
                category VARCHAR(100) NOT NULL,
                description TEXT NOT NULL,
                status ENUM('new', 'investigating', 'resolved') DEFAULT 'new',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS branches (
                id INT AUTO_INCREMENT PRIMARY KEY,
                branch_name VARCHAR(255) NOT NULL,
                address TEXT NOT NULL,
                phone VARCHAR(50),
                email VARCHAR(255),
                latitude DECIMAL(10, 8),
                longitude DECIMAL(11, 8),
                opening_hours VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS blog_posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(255) UNIQUE NOT NULL,
                content TEXT NOT NULL,
                featured_image VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS cv_applications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(50),
                whatsapp VARCHAR(50),
                position VARCHAR(255) NOT NULL,
                cv_file VARCHAR(255) NOT NULL,
                cover_note TEXT,
                status ENUM('new', 'reviewed', 'shortlisted', 'rejected') DEFAULT 'new',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS chatbot_interactions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                question TEXT NOT NULL,
                answer_text TEXT,
                answered TINYINT(1) NOT NULL DEFAULT 0,
                handoff_whatsapp TINYINT(1) NOT NULL DEFAULT 0,
                intent VARCHAR(60) NULL,
                prefill_url VARCHAR(255) NULL,
                source_title VARCHAR(255) NULL,
                source_url VARCHAR(255) NULL,
                status ENUM('new', 'reviewed', 'resolved', 'escalated') NOT NULL DEFAULT 'new',
                review_note TEXT NULL,
                user_ip VARCHAR(64) NULL,
                user_agent VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS lead_scores (
                id INT AUTO_INCREMENT PRIMARY KEY,
                entity_type ENUM('account', 'loan') NOT NULL,
                entity_id INT NOT NULL,
                score INT NOT NULL DEFAULT 0,
                priority ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'low',
                reasons TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY uq_entity (entity_type, entity_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS form_abandonments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                form_type ENUM('open_account', 'loan') NOT NULL,
                session_id VARCHAR(100) NULL,
                full_name VARCHAR(255) NULL,
                email VARCHAR(255) NULL,
                phone VARCHAR(80) NULL,
                current_step VARCHAR(80) NULL,
                payload TEXT NULL,
                converted TINYINT(1) NOT NULL DEFAULT 0,
                reminder_stage TINYINT NOT NULL DEFAULT 0,
                last_reminder_at DATETIME NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_email_form (email, form_type),
                INDEX idx_stage (reminder_stage, converted)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS follow_up_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                abandonment_id INT NOT NULL,
                email VARCHAR(255) NOT NULL,
                stage TINYINT NOT NULL,
                channel ENUM('email') NOT NULL DEFAULT 'email',
                success TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_abandonment (abandonment_id),
                INDEX idx_stage (stage)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS faq_entries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                question TEXT NOT NULL,
                answer_text TEXT NOT NULL,
                source_hint VARCHAR(255) NULL,
                status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
            "CREATE TABLE IF NOT EXISTS managed_pages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                slug VARCHAR(150) NOT NULL UNIQUE,
                title VARCHAR(255) NOT NULL,
                meta_description VARCHAR(255) NULL,
                content LONGTEXT NOT NULL,
                status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        ];

        foreach ($statements as $sql) {
            try {
                $pdo->exec($sql);
            } catch (PDOException $e) {
                // Keep startup resilient; partial schema is better than a crash.
            }
        }
    }
}
