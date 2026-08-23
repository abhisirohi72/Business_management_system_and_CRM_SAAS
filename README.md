# Laravel Business Management & CRM SaaS

A scalable, multi-tenant Business Management & CRM SaaS application built with Laravel.

The platform manages the complete business lifecycle — from lead generation and client management to projects, tasks, quotations, invoices, payments, subscriptions, reports, notifications, and AI-powered assistance.

## Table of Contents

- [Core Modules](#core-modules)
- [Technology Stack](#technology-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [License](#license)

## Core Modules

### 🔐 Authentication
- User registration & login
- Logout & session management
- Password management
- Authentication middleware & secure access control

### 🏢 Multi-Tenancy
- Company-based architecture with company-level data isolation
- Users belong to companies
- Company-specific clients, projects, and resources
- Tenant-aware queries

### 👥 Roles & Permissions
- Role & permission management
- User-role assignment
- Policy-based authorization
- Resource-level access control

### 📊 CRM
**Lead Management**
- Lead creation, tracking & status
- Lead source & conversion
- Follow-ups & lead activities

**Client Management**
- Client CRUD, status, and contact/company info
- Client history & client-project relationship

### 📁 Project Management
- Project CRUD with client assignment
- Status, priority, start/due dates & budget
- Project description & team management

### ✅ Task Management
- Task creation, assignment, status & priority
- Due dates, comments & tracking
- Project-based tasks

### 📝 Quotation
- Client-specific quotations with line items
- Taxes & discounts, quotation status
- PDF generation & sending to clients
- Quotation-to-invoice conversion

### 🧾 Invoice
- Invoice creation with items, taxes & discounts
- Invoice numbering, due dates & status
- PDF generation & client invoices

### 💳 Payment
- Payment recording, status & partial payments
- Payment history & invoice-payment relationship
- Payment tracking

### 🔔 Notifications
- In-app & email notifications
- Task, invoice, payment & system notifications

### 📈 Reports
- Sales, revenue, project, task, client, invoice & payment reports
- Business analytics

### 🌐 REST API
- RESTful architecture with API authentication
- Resource endpoints, request validation & authorization
- JSON responses, pagination & error handling

### ⚡ Queue / Redis
- Laravel Queues with Redis integration
- Background jobs for email, notifications & report generation
- Long-running background tasks

### 📝 Activity Logs
Tracks important business activities: user actions, client/project/task changes, invoice & payment activities, and authentication events.

### 💰 Subscription
- SaaS subscription plans (Free/Paid)
- Feature-based access & plan limits
- Billing cycle & subscription status

### 🤖 AI Assistant
AI-powered business assistant for:
- Business insights & client/project summaries
- Task assistance & report analysis
- Natural language queries
- Automated business recommendations

## Technology Stack

**Backend**
- PHP, Laravel
- Laravel Eloquent ORM, Policies, Form Requests

**Database**
- MySQL / MariaDB

**Frontend**
- Blade, HTML5, CSS3, JavaScript
- Tailwind CSS v4
- Vite

**Infrastructure**
- Redis
- Laravel Queue
- REST API

**Development Tools**
- Composer, NPM, Git, GitHub

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL / MariaDB
- Redis (for queues and caching)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/abhisirohi72/Business_management_system_and_CRM_SAAS.git
   cd Business_management_system_and_CRM_SAAS
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Set up environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database and Redis**

   Update the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=business_crm_saas
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   QUEUE_CONNECTION=redis
   REDIS_HOST=127.0.0.1
   REDIS_PORT=6379
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```
   For development with hot-reload:
   ```bash
   npm run dev
   ```

8. **Start the queue worker** (for background jobs)
   ```bash
   php artisan queue:work
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

   The app will be available at `http://127.0.0.1:8000`

## Project Structure

```
Business_management_system_and_CRM_SAAS/
├── app/            # Application logic (controllers, models, policies, etc.)
├── bootstrap/      # Framework bootstrap files
├── config/         # Configuration files
├── database/       # Migrations & seeders
├── public/         # Publicly accessible entry point
├── resources/      # Blade views, JS, and CSS source files
├── routes/         # Route definitions (web & API)
├── storage/        # Logs, cache, uploaded files
└── tests/          # Automated tests
```

## License

This project is proprietary software. All rights reserved.

## Contact

**Abhishek Sirohi**
📧 abhisirohi72@gmail.com
🔗 [GitHub](https://github.com/abhisirohi72)