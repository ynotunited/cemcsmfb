PRD — DIGITAL BANKING EXPERIENCE PLATFORM
Architecture: Monolithic PHP Web App (Shared Hosting Ready)

1. High-Level Architecture

This will be a modular PHP MVC app.
Think Laravel-style structure without requiring Laravel.

/public
/app
    /controllers
    /models
    /views
    /helpers
/config
/uploads
/assets

Why this matters:
Easy deployment via cPanel
No server dependencies
Scalable enough for traffic
2. Core System Modules
Public Website
Account Opening System
Loan Application System
Financial Calculators
Help Centre + Complaints
Branch Locator
Admin Dashboard
Notification Engine
3. Database Design (Core Tables)
USERS (Admin accounts)
id
name
email
password
role (admin/staff)
created_at
ACCOUNT_APPLICATIONS
id
account_type
full_name
dob
phone
email
address
occupation
id_document
passport_photo
utility_bill
status (new/contacted/approved/rejected)
created_at
LOAN_APPLICATIONS
id
loan_type
amount
duration
employment_status
monthly_income
business_name
documents
status
created_at
CONTACT_MESSAGES
id
name
email
phone
message
created_at
COMPLAINTS
id
name
email
phone
category
description
status
created_at
BRANCHES
id
branch_name
address
phone
email
latitude
longitude
opening_hours
BLOG_POSTS
id
title
slug
content
featured_image
created_at

4. Routing Structure

Shared hosting friendly routing via .htaccess.
Example routes:
/                → Home
/about           → About page
/personal        → Personal banking
/business        → Business banking
/loans           → Loans page
/open-account    → Account form
/apply-loan      → Loan form
/calculators     → Financial tools
/branches        → Branch locator
/help            → Help centre
/contact         → Contact page
/admin           → Admin login

5. Account Opening System (Detailed)
Multi-step form using JS (no reloads)

Steps stored in session until final submit.
After submit:
Save to DB
Upload documents to /uploads/kyc/
Send email notification to bank staff
Send confirmation email to user

6. Loan Application Engine

Similar multi-step form.
Documents stored:
/uploads/loans/
Admin dashboard receives new lead instantly.

7. Financial Calculators Logic

Pure JavaScript (no server load).
Loan Formula
M = P × r × (1+r)^n / ((1+r)^n − 1)
Savings Future Value
FV = P × ((1+r)^n − 1) / r

Fast and hosting-friendly.

8. Admin Dashboard

URL:
/admin

Features:
Authentication
Secure login
Password hashing
Dashboard Widgets
Total account applications
Total loan applications
New messages
New complaints
Lead Management

Admins can:
View applications
Change status
Export CSV

9. Notification Engine

Shared hosting safe email system using SMTP.

Triggers:
Event	Action
Account application	Email staff
Loan application	Email staff
Contact form	Email staff
Complaint	Email staff

Optional:
WhatsApp via API later.

10. Security Requirements

Critical because banking brand:
• reCAPTCHA on all forms
• CSRF tokens
• Password hashing (bcrypt)
• File upload validation
• HTTPS enforced
• Admin route protection

11. Performance Strategy

Because shared hosting:
• No heavy frameworks
• No server rendering engines
• Optimized images
• Lazy loading
• Minified assets
• Caching headers

Target:
< 2.5s load time

12. Deployment Plan

Client hosting requirements:
PHP 8+
MySQL 5.7+
SSL certificate
SMTP email access

Deployment steps:
Upload files via cPanel
Import database
Update config file
Go live

13. MVP vs Phase 2
MVP (Launch)

Everything in this PRD.
Phase 2 (Future)
CRM integration
Chatbot
Appointment booking
Analytics dashboard
API integration with core banking