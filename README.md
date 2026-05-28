````md
# Laravel Management System Template

A responsive blank management system template built with Laravel 10 and MySQL.

This template is designed as a starting point for building custom management systems and admin panels. It includes responsive layouts, role management, dark mode support, dynamic navigation management, and SMTP mail configuration.

---

# Features

- Laravel 10
- MySQL Database
- Responsive Design
- Automatic Dark Mode Support
- User Role Management
- Dynamic Navigation Menu Management
- SMTP Mailer Configuration
- Database Session Support
- Database Queue Support
- Sanctum Domain Binding Support

---

# Installation

## 1. Clone the Repository

```bash
git clone YOUR_REPOSITORY_URL
```
````

---

## 2. Navigate to Project Directory

```bash
cd YOUR_PROJECT_NAME
```

---

## 3. Install PHP Dependencies

```bash
composer install
```

---

## 4. Install Node Dependencies

```bash
npm install
```

---

## 5. Configure Environment File

Copy the `.env.example` file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

# Environment Configuration

Update the following `.env` values:

```env
APP_URL=http://localhost:8000

BROADCAST_DRIVER=log
CACHE_DRIVER=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

SANCTUM_STATEFUL_DOMAINS=
SESSION_DOMAIN=null
```

---

## Important Notes

### APP_URL

Make sure to update the `APP_URL` with your own local URL or domain.

Example:

```env
APP_URL=http://localhost:8000
```

This is important to avoid component and asset loading issues.

---

### Sanctum Domain Configuration

```env
SANCTUM_STATEFUL_DOMAINS=
SESSION_DOMAIN=null
```

These configurations allow you to bind your own domain or local URL properly and help prevent unauthorized external access.

---

# Database Setup

Update your database credentials inside `.env`.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

---

# Run Database Migration

```bash
php artisan migrate
```

---

# Seed Default Data

```bash
php artisan db:seed
```

This will generate the default roles and required initial data.

---

# Default User Roles

The system comes with the following default roles:

```php
['id' => 1, 'role_name' => 'superadmin'],
['id' => 2, 'role_name' => 'admin'],
['id' => 3, 'role_name' => 'user'],
['id' => 4, 'role_name' => 'developer'],
```

---

# Default Navigation Menus

## Dashboard

The main dashboard page of the system.

Used for displaying summaries, widgets, statistics, and other system overviews.

---

## User Management

This section is used for managing system users.

Features include:

- Create Users
- Edit Users
- Assign Roles
- Manage User Accounts

---

## Developer

The developer section contains advanced system configuration tools.

### Mailer

Used to configure SMTP mail settings.

This configuration is used for:

- Notifications
- Email Verification
- Password Reset Emails
- Other email-related activities

---

### Menus

Used to manage navigation menus.

Important Notes:

- Navigation menu creation is NOT automated.
- Every additional menu item must also have its corresponding Laravel web route manually created.

Example:

```php
Route::get('/sample-page', function () {
    return view('sample-page');
});
```

---

# Dark Mode Support

The template automatically detects the browser theme.

If the user's browser or operating system is in dark mode, the application will automatically switch to dark mode as well.

---

# Running the Application

Start the Laravel server:

```bash
php artisan serve
```

Run Vite:

```bash
npm run dev
```

---

# Tech Stack

- Laravel 10
- PHP
- MySQL
- Tailwind CSS
- Vite

---

# License

This template is open for customization and project development.

```

```
