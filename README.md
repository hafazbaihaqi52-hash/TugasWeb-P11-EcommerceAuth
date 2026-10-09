# Tugas Web P11 — E-Commerce DB + Secure Auth

Project ini merupakan tugas **Pemrograman Web Pertemuan 11 (P11)** dengan topik **E-Commerce Database dan Secure Authentication** menggunakan Laravel.

Project mencakup pengelolaan database e-commerce menggunakan Eloquent ORM, seeding dan factory, authentication menggunakan Laravel Breeze, sistem multi-role, middleware, serta authorization menggunakan Policy.

## 👨‍💻 Identitas

**Nama:** Muhammad Hafaz Baihaqi
**Mata Kuliah:** Pemrograman Web
**Pertemuan:** 11
**Project:** E-Commerce DB + Secure Auth

---

## 🛠️ Teknologi yang Digunakan

* PHP 8.5.11
* Laravel 13.34.0
* MySQL
* Laravel Eloquent ORM
* Laravel Breeze
* Blade
* Vite
* XAMPP
* Composer

---

## 📌 Fitur Project

### 1. Database & Eloquent

Project memiliki database e-commerce dengan beberapa tabel yang saling berhubungan, yaitu:

* Users
* Categories
* Products
* Orders
* Order Items
* Tags
* Product Tag

Selain itu terdapat tabel tambahan untuk kebutuhan authentication dan authorization.

### 2. Migration

Database dibuat menggunakan Laravel Migration dan dilengkapi dengan:

* Struktur tabel
* Primary Key
* Foreign Key
* Relasi antar tabel
* Constraint database

Migration dapat dijalankan menggunakan:

```bash
php artisan migrate
```

Untuk membuat ulang database sekaligus menjalankan seeder:

```bash
php artisan migrate:fresh --seed
```

### 3. Seeder & Factory

Project menggunakan Seeder dan Factory untuk menghasilkan data awal.

Data yang tersedia antara lain:

* 50 produk
* 10 kategori
* 15 tag
* 5 order
* 18 order item
* Data user untuk kebutuhan testing

Data produk dibuat menggunakan Factory sehingga data lebih realistis dan dapat digunakan untuk pengujian aplikasi.

### 4. Eloquent Relationship

Project menggunakan relasi Eloquent untuk menghubungkan data antar model.

Contoh relasi:

* User memiliki banyak Order
* Order memiliki banyak Order Item
* Product memiliki Category
* Product memiliki banyak Tag
* Post dimiliki oleh User

Project juga menggunakan eager loading untuk mengambil data relasi secara lebih efisien.

Contoh:

```php
Post::with('user')->get();
```

### 5. Query Scope

Terdapat custom query scope pada model Product untuk mendapatkan produk yang masih tersedia.

Contoh:

```php
Product::available()->get();
```

Scope tersebut digunakan untuk memfilter produk berdasarkan stok yang tersedia.

---

# 🔐 Authentication & Security

## 6. Laravel Breeze

Authentication dibuat menggunakan Laravel Breeze.

Fitur authentication yang tersedia:

* Login
* Register
* Logout
* Session authentication
* Password hashing

Route authentication disediakan oleh Laravel Breeze.

---

## 7. Multi-Role

Project memiliki tiga role pengguna:

| Role     | Keterangan                   |
| -------- | ---------------------------- |
| `admin`  | Memiliki akses administrator |
| `editor` | Memiliki akses editor        |
| `user`   | Pengguna biasa               |

Contoh data role:

```text
admin
editor
user
```

### Akun Testing

**Admin**

```text
Email: hafazbaihaqi52@gmail.com
Role : admin
```

**Editor**

```text
Email: editor@gmail.com
Role : editor
```

**User**

```text
Email: user@gmail.com
Role : user
```

> Password akun testing tidak dicantumkan di repository.

---

## 8. Custom Middleware

Project menggunakan custom middleware untuk membatasi akses berdasarkan role.

Route dilindungi menggunakan middleware:

```php
auth
role:admin
role:editor
role:user
```

Contoh:

```php
Route::middleware(['auth', 'role:admin'])
    ->get('/admin', function () {
        return view('admin');
    });
```

Dengan middleware tersebut, pengguna yang tidak memiliki role yang sesuai tidak dapat mengakses halaman tertentu.

---

# 🛡️ Authorization — PostPolicy

Project menggunakan `PostPolicy` untuk mengatur hak akses terhadap Post.

Hak akses yang diterapkan:

* Admin dapat melakukan update dan delete.
* Editor dapat melakukan update dan delete.
* User hanya dapat melakukan update/delete terhadap post miliknya sendiri.

Contoh authorization:

```php
$user->can('update', $post);
```

dan:

```php
$user->can('delete', $post);
```

### Hasil Pengujian

| User       | Role   | Update  | Delete  |
| ---------- | ------ | ------- | ------- |
| Hafaz      | admin  | ✅ true  | ✅ true  |
| Editor P11 | editor | ✅ true  | ✅ true  |
| User P11   | user   | ❌ false | ❌ false |

Pengujian dilakukan menggunakan Laravel Tinker.

---

# 🧪 Pengujian Route & Role

Pengujian dilakukan menggunakan dua akun dengan role berbeda.

### Admin

Admin berhasil mengakses:

```text
/admin
```

### Editor

Editor berhasil mengakses:

```text
/editor
```

Editor tidak dapat mengakses:

```text
/admin
```

karena route tersebut dilindungi oleh middleware:

```text
role:admin
```

Pengujian juga dilakukan menggunakan browser Incognito untuk memastikan session dan pembatasan role berjalan dengan benar.

---

# 💻 Cara Menjalankan Project

### 1. Clone atau salin repository

Letakkan project di folder:

```text
C:\xampp0\htdocs\
```

### 2. Masuk ke folder project

```bash
cd C:\xampp0\htdocs\TugasWeb-P11-EcommerceAuth
```

### 3. Install dependency PHP

```bash
composer install
```

### 4. Install dependency frontend

```bash
npm install
```

### 5. Buat file `.env`

Salin:

```text
.env.example
```

menjadi:

```text
.env
```

Kemudian sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tugas_p11
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate application key

```bash
php artisan key:generate
```

### 7. Jalankan migration dan seeder

```bash
php artisan migrate:fresh --seed
```

### 8. Jalankan server Laravel

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

---

# 📊 Data Hasil Pengujian

Beberapa data yang berhasil diuji:

```text
Products : 50
Categories : 10
Tags : 15
Orders : 5
Order Items : 18
```

Query Tinker yang digunakan untuk dokumentasi antara lain:

```php
App\Models\Product::count();
```

```php
App\Models\Product::with('category')->first();
```

```php
App\Models\User::first()->orders->count();
```

```php
App\Models\Order::withSum('items as total','price')->first();
```

```php
App\Models\Product::available()->take(5)->get();
```

---

# 🔒 Catatan Keamanan

File berikut **tidak disertakan dalam repository**:

```text
.env
vendor/
node_modules/
```

File `.env` tidak boleh di-upload karena dapat berisi konfigurasi dan informasi sensitif.

Project menggunakan beberapa mekanisme keamanan Laravel, antara lain:

* Authentication
* Password hashing
* CSRF protection
* Middleware
* Authorization Policy
* Eloquent ORM
* Route protection

---

# 📁 Struktur Project

Struktur utama project:

```text
TugasWeb-P11-EcommerceAuth/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
└── README.md
```

---

# ✅ Status Project

Project **Tugas Web P11 — E-Commerce DB + Secure Auth** telah mencakup requirement utama:

* [x] Migration database
* [x] Foreign key
* [x] Seeder & Factory
* [x] 50+ produk
* [x] Eloquent relationships
* [x] Query Scope
* [x] Dokumentasi 5 Query Tinker
* [x] Laravel Breeze
* [x] Login / Register / Logout
* [x] Multi-role
* [x] Custom Middleware
* [x] PostPolicy
* [x] Route Protection
* [x] Testing 2 Role
* [x] Testing Incognito

**Project siap dikumpulkan.**
