# SecureMart - Simple E-Commerce (Laravel 12)

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css)
![Security](https://img.shields.io/badge/Security-SQL%20Injection%20Proof-brightgreen?style=for-the-badge&logo=shield)

**SecureMart** adalah aplikasi E-Commerce sederhana yang dibangun menggunakan **Laravel 12**. Proyek ini dikembangkan sebagai Tugas Akhir mata kuliah **Keamanan Informasi** untuk mendemonstrasikan implementasi kode yang aman (Secure Coding), khususnya dalam pencegahan serangan **SQL Injection**.

Selain keamanan, aplikasi ini juga mengedepankan User Interface (UI) yang bersih dan interaktif menggunakan Tailwind CSS dan notifikasi animasi modern.

## 🚀 Fitur Utama

### 🛡️ Keamanan (Security Focus)
* **Anti SQL Injection:** Menggunakan Eloquent ORM & Parameter Binding untuk semua query database.
* **CSRF Protection:** Proteksi otomatis pada setiap form input.
* **Authorization:** Middleware & Gate Policy untuk memisahkan akses Admin, Seller, dan Buyer.

### 🛒 Fungsionalitas E-Commerce
* **Multi-Role:**
    * **Buyer:** Bisa mencari produk, melihat detail, dan membeli (Checkout).
    * **Seller:** Bisa menambah, mengedit, dan menghapus produk sendiri.
    * **Admin:** Bisa memantau statistik dan mengelola user.
* **Katalog Produk:** Tampilan grid modern dengan placeholder inisial nama (tanpa gambar).
* **Pencarian:** Fitur pencarian real-time yang menjadi objek demo keamanan.
* **Checkout & Riwayat:** Simulasi pembelian dengan pengurangan stok otomatis dan pencatatan riwayat pesanan.

### 🎨 UI/UX Modern
* **Tailwind CSS (CDN):** Styling responsif dan rapi tanpa build process yang berat.
* **Interactive Feedback:** Notifikasi menggunakan **SweetAlert2**.
* **Celebration Animation:** Efek **Confetti** (ledakan kertas) saat pembelian berhasil.

---

## 💻 Tech Stack

* **Framework:** Laravel 12
* **Bahasa:** PHP 8.2+
* **Database:** SQLite (Default) / MySQL
* **Frontend:** Blade Templates + Tailwind CSS (via CDN)
* **Libraries:**
    * SweetAlert2 (Popups)
    * Canvas Confetti (Animation)

---

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/yromic/simple-ecommerce.git](https://github.com/yromic/simple-ecommerce.git)
    cd secure-mart
    ```

2.  **Install Dependensi**
    ```bash
    composer install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```

4.  **Generate Key**
    ```bash
    php artisan key:generate
    ```

5.  **Setup Database (SQLite)**
    Pastikan file database tersedia (jika menggunakan SQLite):
    * Buat file kosong bernama `database.sqlite` di dalam folder `database/`.
    * Jalankan migrasi tabel:
    ```bash
    php artisan migrate:fresh
    ```

6.  **Jalankan Aplikasi**
    ```bash
    php artisan serve
    ```
    Buka browser dan akses: `http://127.0.0.1:8000`

---

## 🧪 Skenario Pengujian Keamanan

Untuk mendemonstrasikan keamanan sistem terhadap **SQL Injection** di depan dosen/penguji:

### Skenario: Pencarian Produk
Pada input pencarian yang tidak aman, penyerang biasanya memasukkan payload seperti:
`' OR '1'='1`

1.  Masuk ke menu **Katalog / Pencarian**.
2.  Masukkan payload: `' OR '1'='1` pada kolom pencarian.
3.  **Hasil:** Aplikasi akan menampilkan **"Produk tidak ditemukan"**.
4.  **Kesimpulan:** Sistem **AMAN**. Eloquent ORM berhasil menganggap input tersebut sebagai *string literal* (teks biasa), bukan sebagai logika SQL yang dieksekusi. Database tidak bocor.

**Kode Pengaman (Controller):**
```php
// app/Http/Controllers/ProductController.php

// Aman karena menggunakan Parameter Binding otomatis via Eloquent
$products = Product::where('name', 'like', "%{$query}%")->get();
