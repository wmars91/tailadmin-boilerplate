# TailAdmin Boilerplate

Boilerplate project Laravel 12 + TailAdmin dengan fitur lengkap untuk admin dashboard.

## Tech Stack

- **Laravel 12** - PHP Framework
- **TailAdmin** - Tailwind CSS Admin Dashboard Template
- **Laravel Breeze** - Authentication (Login via Username)
- **Spatie Permission** - Role & Permission Management
- **Alpine.js** - JavaScript Framework
- **Vite** - Build Tool

## Fitur

- ✅ Login menggunakan **username** (bukan email)
- ✅ Dynamic menu dari database dengan permission-based filtering
- ✅ CRUD Menu Management
- ✅ CRUD User Management + assign role
- ✅ CRUD Role Management + assign permissions
- ✅ Dark mode support
- ✅ Responsive sidebar

## Instalasi

### 1. Clone Repository

```bash
git clone <repository-url> tailadmin-boilerplate
cd tailadmin-boilerplate
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tailadmin_boilerplate
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migration & Seeder

```bash
php artisan migrate:fresh --seed
```

### 5. Jalankan Aplikasi

```bash
npm run dev
php artisan serve
```

Atau jika menggunakan Laragon, akses: `http://tailadmin-boilerplate.test`

## Default Login

| Field    | Value      |
|----------|------------|
| Username | `admin`    |
| Password | `password` |

## Struktur Custom

```
app/
├── Helpers/
│   └── MenuHelper.php          # Dynamic menu dari database
├── Http/Controllers/
│   ├── MenuController.php      # CRUD Menu
│   ├── UserController.php      # CRUD User + Role
│   └── RoleController.php      # CRUD Role + Permission
├── Models/
│   ├── User.php                # + HasRoles, custom fields
│   └── Menu.php                # Menu model (parent-child)
database/
├── seeders/
│   ├── RolePermissionSeeder.php
│   └── MenuSeeder.php
resources/views/
├── menus/                      # CRUD views
├── users/                      # CRUD views
├── roles/                      # CRUD views
├── layouts/                    # TailAdmin layout
└── auth/login.blade.php        # Login (username)
```

📚 **Ingin membuat menu baru dan membatasinya untuk hak akses (Role) tertentu?** 
Baca panduan lengkapnya di sini: **[Panduan Manajemen Menu, Role & Permission](panduan_menu_dan_role.md)**.

## Custom User Fields

| Field       | Deskripsi         |
|-------------|-------------------|
| username    | Login username    |
| nip         | Nomor Induk Pegawai |
| departement | Departemen        |
| company     | Perusahaan        |
| kdcab       | Kode Cabang       |

## License

MIT
