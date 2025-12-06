# Application Overview

This document provides a comprehensive technical overview of the application, covering the technology stack, database schema, application structure, and key features. It is intended to serve as a resource for presentations and proposals.

## 1. Technology Stack

### Backend
- **Framework:** Laravel 12.0
- **Language:** PHP 8.2+
- **Dependencies:**
    - `barryvdh/laravel-dompdf`: PDF generation
    - `realrashid/sweet-alert`: Alert notifications

### Frontend
- **Build Tool:** Vite 7.0
- **CSS Framework:** Tailwind CSS 4.0
- **HTTP Client:** Axios
- **Plugins:** `laravel-vite-plugin`, `autoprefixer`, `postcss`

### Database
- **Type:** Relational Database (MySQL/MariaDB compatible)
- **ORM:** Eloquent ORM (Laravel default)

## 2. Database Schema

The application uses a relational database with the following key tables:

### `users`
- Stores authentication credentials.
- **Key Fields:** `id`, `name`, `email`, `password`, `role` (implied/managed via middleware).

### `candidates`
- Stores registration information for students.
- **Relationships:** Belongs to `User`.
- **Key Fields:**
    - `registration_number`: Unique identifier.
    - `level`: Education level (TK, SD, SMP, SMA, SMK).
    - `major`: Study major (PPLG, AKL, MPLB) - *nullable*.
    - `status`: Application status (draft, submitted, verified, accepted, rejected).
    - `exam_date`: Scheduled exam date.

### `candidate_profiles`
- Stores detailed personal information of the candidate.
- **Relationships:** Belongs to `Candidate`.
- **Key Fields:**
    - `nisn`: National Student ID.
    - `place_of_birth`, `date_of_birth`: Birth details.
    - `gender`: L (Male) / P (Female).
    - `religion`, `address`, `phone`.
    - `father_name`, `mother_name`: Parent information.

### `candidate_documents`
- Stores paths to uploaded documents.
- **Relationships:** Belongs to `Candidate`.
- **Key Fields:**
    - `file_type`: Type of document (photo, family_card, report_card, payment_proof).
    - `file_path`: Storage path.

## 3. Application Structure

### Directory Structure
- **`app/Http/Controllers`**: Contains logic for handling requests.
    - `AuthController`: Login/Logout logic.
    - `RegisterController`: Student registration logic.
    - `CandidateController`: Student dashboard and data management.
    - `AdminController`: Admin verification and dashboard.
    - `PageController`: Public pages (Welcome, Level info).
- **`app/Models`**: Eloquent models representing database tables (`User`, `Candidate`, `CandidateProfile`, `CandidateDocument`).
- **`database/migrations`**: Database schema definitions.
- **`resources/views`**: Blade templates for the UI.
- **`routes/web.php`**: Web application routes.

## 4. Key Features & User Flow

### Public Access
- **Landing Page:** General information about the school.
- **Level Information:** Specific pages for different education levels (TK, SD, SMP, SMA, SMK).

### Student Portal
1.  **Registration:** New users can create an account.
2.  **Dashboard:** View application status.
3.  **Biodata Management:** Fill in and update personal details.
4.  **Document Upload:** Upload necessary documents (Photo, KK, Rapor).
5.  **Payment:** Upload payment proof.

### Admin Portal
1.  **Dashboard:** Overview of applicants.
2.  **Verification:** Review candidate data and documents.
3.  **Status Management:** Update candidate status (e.g., Verify, Accept, Reject).
4.  **Exam Scheduling:** Set exam dates for candidates.

## 5. Security & Best Practices
- **Authentication:** Laravel's built-in authentication system.
- **Authorization:** Role-based access control (Middleware: `auth`, `admin`).
- **Data Validation:** Server-side validation for all inputs.
- **File Security:** Secure storage for uploaded documents.
