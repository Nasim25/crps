# CRPS (Custom Role Permission System)

A Laravel 12 based custom role and permission management system without using third-party packages like Spatie. This project provides:

* Basic Admin Authentication (Sanctum-based API login)
* Role and Permission creation & assignment
* Middleware for role & permission-based route protection
* Full PHPUnit Feature & Unit Test Coverage

---

## 🚀 Installation

### 1. Clone & Setup

```bash
git clone https://github.com/your-username/crps.git
cd crps
cp .env.example .env
composer install
php artisan key:generate
```

### 2. Database Setup

* Create a new database `crps` (or as configured in `.env`)

```bash
php artisan migrate
```

### 3. Sanctum Installation

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

### 4. Seed Basic Admin (Optional)

```bash
php artisan db:seed --class=AdminSeeder
```

---

## 🔐 Authentication

* API-based login using `Sanctum`
* Login Endpoint:

```
POST /api/login
{
  "email": "admin@example.com",
  "password": "password"
}
```

* Returns token:

```
{
  "token": "<API-TOKEN>"
}
```

Include this token in header for protected routes:

```
Authorization: Bearer <API-TOKEN>
```

---

## 🧾 Role & Permission

### Create Role

```bash
php artisan make:role Admin
```

### Assign Role to User

```php
$user->assignRole('Admin');
```

### Assign Permission to Role

```php
$role->givePermissionTo('edit-post');
```

### Middleware Usage

```php
Route::middleware(['role:Admin'])->group(function () {
  // Admin-only routes
});

Route::middleware(['permission:edit-post'])->get('/edit', function () {
  // Routes requiring 'edit-post' permission
});
```

---

## ✅ Running Tests

```bash
php artisan test
```

Make sure `.env.testing` has a valid test DB setup and `APP_KEY` generated:

```bash
php artisan key:generate --env=testing
```

All tests are located in `tests/Feature` and `tests/Unit`.

---

## 📦 Folder Structure

* `app/Http/Middleware/RoleMiddleware.php`
* `app/Http/Middleware/PermissionMiddleware.php`
* `app/Traits/HasRoles.php` — Handles role/permission logic
* `tests/Feature` — Feature tests (middleware, login, role-permission)
* `routes/api.php` — API endpoints
* `routes/web.php` — Web endpoints

---

## 🛠 Technologies

* Laravel 12
* Sanctum
* PHPUnit
* MySQL

---

## 📄 License

This project is open-sourced and free to use.

---

## 👤 Author

**Nasim**
Laravel Developer
