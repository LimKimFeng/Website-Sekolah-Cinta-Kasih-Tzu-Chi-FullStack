<div align="center">

<img src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2020/12/Main-Logo.png" width="200" alt="Sekolah Cinta Kasih Tzu Chi Logo" />

# Sekolah Cinta Kasih Tzu Chi - PPDB System

**A Modern, Secure, and Humanist Student Admission Platform**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)
[![Security](https://img.shields.io/badge/Security-Hardened-success?style=for-the-badge&logo=cloudflare)](https://cloudflare.com)

[Features](#-key-features) • [Architecture](#-system-architecture) • [Security](#-security-measures) • [Installation](#-installation-guide)

</div>

---

## 📖 Introduction

The **PPDB (Penerimaan Peserta Didik Baru)** System for Sekolah Cinta Kasih Tzu Chi is a state-of-the-art web application designed to streamline the student admission process. Built with a focus on **User Experience (UX)**, **Security**, and **Performance**, this platform serves thousands of prospective students from Kindergarten (TK) to Vocational High School (SMK).

The system embodies the school's philosophy of *humanist education* by providing a friendly, accessible, and transparent digital experience for parents and students.

## 🏗 System Architecture

This application is built on a robust monolithic architecture using the **Laravel** framework, ensuring reliability and scalability.

| Component | Technology | Description |
| :--- | :--- | :--- |
| **Backend** | Laravel 11 (PHP 8.2+) | Handles business logic, routing, and database interactions. |
| **Frontend** | Blade + TailwindCSS | Server-side rendering with a modern, utility-first CSS framework for responsive UI. |
| **Database** | MySQL | Relational database for storing user, candidate, and administrative data. |
| **Assets** | Vite | Next-generation frontend tooling for blazing fast builds. |
| **Bot Protection** | Cloudflare Turnstile | Privacy-focused CAPTCHA alternative to prevent automated abuse. |

## 🛡 Security Measures

Security is a top priority. We have implemented a multi-layered security strategy to protect user data and application integrity.

### 🤖 Bot & Abuse Protection
- **Cloudflare Turnstile**: Integrated into Login and Registration forms to block bots without annoying users.
- **Honeypot Mechanism**: Hidden fields (`b_field`) trap simple bots that blindly fill forms.
- **Time-Based Validation**: Forms submitted faster than humanly possible (< 5s) are automatically rejected.
- **Rate Limiting**: Login endpoints are throttled (5 attempts/min) to prevent brute-force attacks.

### 🔒 Data Privacy & Integrity
- **Mass Assignment Protection**: Strict controller logic ensures only validated data is written to the database.
- **Strict Mode**: Eloquent Strict Mode is enabled in non-production environments to prevent N+1 queries and lazy loading violations.
- **Input Sanitization**: All user inputs are validated and sanitized to prevent injection attacks.

### 🌐 Network Security
- **Security Headers**: A dedicated middleware injects industry-standard security headers:
    - `X-Content-Type-Options: nosniff`
    - `X-Frame-Options: SAMEORIGIN`
    - `X-XSS-Protection: 1; mode=block`
    - `Referrer-Policy: strict-origin-when-cross-origin`
    - `Strict-Transport-Security` (HSTS) in production.

## 🚀 Key Features

### 🎓 Student Portal
- **Seamless Registration**: Easy-to-use wizard for account creation and biodata submission.
- **Real-time Dashboard**: Track application status (Draft -> Submitted -> Verified -> Accepted).
- **Document Upload**: Secure upload for payment proofs and required documents.
- **Exam Schedule**: Automatic display of exam dates upon verification.

### 👨‍💼 Admin Portal
- **Candidate Management**: View, filter, and manage all student applications.
- **Verification Workflow**: One-click verification of data and payment proofs.
- **Automated Communication**: System automatically sends email notifications and generates PDF Exam Cards upon verification.

## 💻 Installation Guide

Follow these steps to set up the project locally.

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Steps

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/yourusername/ppdb-tzu-chi.git
    cd ppdb-tzu-chi
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure Database & Keys**
    Open `.env` and set your database credentials. Also, add your Cloudflare Turnstile keys:
    ```env
    DB_DATABASE=tzu_chi
    DB_USERNAME=root
    DB_PASSWORD=

    TURNSTILE_SITE_KEY=your_site_key
    TURNSTILE_SECRET_KEY=your_secret_key
    ```

5.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

6.  **Build Assets & Run Server**
    ```bash
    npm run build
    php artisan serve
    ```

    Visit `http://127.0.0.1:8000` to see the application.

---

<div align="center">
    <p>Developed with ❤️ for Sekolah Cinta Kasih Tzu Chi</p>
    <p>&copy; 2025 All Rights Reserved.</p>
</div>
