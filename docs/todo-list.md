# Project Roadmap: Chevron CEMCS MFB - Digital Banking Platform

## 🎯 Executive Summary
This document serves as the master checklist to prosecute the Chevron CEMCS MFB Digital Banking Experience Platform. The goal is to build a monolithic, highly scalable, zero-dependency PHP MVC app designed for easy shared hosting (cPanel) deployment. 

The application will heavily prioritize a **mobile-first, app-like experience**.

## 🛠 Required Skills for Prosecution
We will activate the following agentic skills to ensure maximum quality:
1. **`ui-ux-pro-max`**: Leveraged for all views to build the cinematic, mobile-first interface. This skill will ensure the app feels native to touch devices (large touch targets, smooth easing, structured gestures) while faithfully adhering to the Chevron CEMCS brand guidelines (DM Sans, Cormorant Garamond, Brand Colors).
2. **`clean-php-architect`**: To build the custom, lightweight MVC router and controller logic without relying on Laravel or external packages, keeping shared-hosting compatibility pristine.
3. **`js-interactivity-master`**: To construct the pure JavaScript multi-step forms (no reloads) and financial calculators, ensuring zero server-lag.
4. **`secure-backend-defender`**: To rigorously audit the application for banking-level security (reCAPTCHA, CSRF, bcrypt hashing, MIME validation for KYC uploads).

---

## 📅 Roadmap & Sequence

### Phase 1: Foundation & Architecture (Backend)
- [x] Define the `.htaccess` file to handle all routing toward `index.php`.
- [x] Scaffold the project directory structure (`/public`, `/app/controllers`, `/app/models`, `/app/views`, `/uploads`, `/config`).
- [x] Create the core routing engine.
- [x] Create the database connection singleton (`config/db.php`).
- [x] Create initial SQL schema script for `USERS`, `ACCOUNT_APPLICATIONS`, `LOAN_APPLICATIONS`, `CONTACT_MESSAGES`, `COMPLAINTS`, `BRANCHES`, and `BLOG_POSTS`.

### Phase 2: The Design System (Frontend / ui-ux-pro-max)
- [x] Ingest the `chevron-cemcs-mfb-brand-guide.html` and define global CSS variables in `/assets/css/globals.css`.
- [x] Define a rigid typography scale and layout spacing scale (Anti-Gravity patterns).
- [x] Build standard UI components (Buttons, Inputs, Cards) with subtle hover/active states.
- [x] Construct the core responsive App Shell (Mobile-first Navigation, Footer).

### Phase 3: Public Interactivity & Landing Pages
- [x] Build the Home Page (Hero, Quick Action buttons, Feature sections).
- [x] Build the About, Personal Banking, and Business Banking informational pages.
- [x] Build the Help Centre and Contact/Complaints pages.
- [x] Implement the Branch Locator (integrating Google Maps or simple list-view).

### Phase 4: Financial Calculators (Pure JS)
- [x] Build the Loan Calculator (calculating EMIs dynamically).
- [x] Build the Savings Future Value Calculator.
- [x] Implement dynamic updating charts/bars for the calculators if scoped.

### Phase 5: Account & Loan Applications (Multi-step JS Forms)
- [x] Build the UI for the Multi-step Account Opening Form.
- [x] Build the UI for the Loan Application Form.
- [x] Employ `js-interactivity-master` to handle state transitions between form steps, validations, and progress bars smoothly.
- [x] Implement final form submission passing payload via `fetch` to backend endpoints.

### Phase 6: Form Handlers & Secure File Uploads
- [x] Build the PHP backend controller for Contact & Complaint form ingestion.
- [x] Build the PHP backend controller for Account Applications (handling KYC uploads safely into `/uploads/kyc/`).
- [x] Build the PHP backend controller for Loan Applications.
- [x] Add strict input sanitization and implement CSRF verification.

### Phase 7: Admin Dashboard & SMTP Notifications
- [x] Build the Secure Admin login view.
- [x] Write authentication logic and session management (employing `bcrypt`).
- [x] Develop the Admin Dashboard showing total applications, leads, metrics.
- [x] Develop the Lead Management interfaces (Approve/Reject leads).
- [x] Add CSV export functionality.
- [x] Integrate simple SMTP mailing class to handle staff/applicant notifications on form submissions.

### Phase 8: Final Review & Optimization
- [x] Perform a mobile-specific UX audit (testing on simulated mobile viewports).
- [x] Enforce security checks (SQL injection, XSS, upload directory execution prevention).
- [x] Optimize load performance (minification, lazy-loading) to ensure <2.5s load times.
- [x] Package for final cPanel deployment.
