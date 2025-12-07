# Inventory Manager – Kelompok 25

## Teknologi Utama
- PHP 8 (native, tanpa framework)
- Tailwind CSS (via CDN untuk pengembangan cepat)
- Router & Controller kustom
- PDO untuk akses database MySQL
- Struktur modular (views/layouts/partials) agar mudah di-scale

## Struktur Folder

```
kelompok_25/
├─ public/                      # Hanya direktori ini yang diakses browser
│  ├─ index.php                 # Front controller (semua request masuk sini)
│  ├─ .htaccess                 # Rewrite ke index.php (untuk Apache)
│  └─ assets/
│     ├─ css/app.css            # Style global
│     ├─ js/app.js             # Script global
│     ├─ js/modules/           # Script per fitur (auth/materials/stock/reports)
│     ├─ img/                  # Static assets
│     └─ uploads/materials/    # Foto bahan hasil upload
│
├─ src/
│  ├─ config/                  # Konfigurasi environment & koneksi DB
│  ├─ core/                    # Router, Base Controller, Auth helper, dll
│  ├─ routes/                  # `web.php` (view) & `api.php` (JSON)
│  ├─ models/                  # User, Role, Material, Supplier, Stock, dll
│  ├─ controllers/
│  │  ├─ web/                  # Controller yang merender view
│  │  └─ api/                  # Controller untuk request AJAX/JSON
│  ├─ views/                   # Layout, partial, dashboard, materials, dsb.
│  ├─ middleware/              # AuthMiddleware & RoleMiddleware
│  └─ helpers/                 # Utility (redirect, csrf, validator)
│
├─ tailwind.config.js
├─ package.json
└─ README.md
```

## Alur Singkat
1. Request masuk ke `public/index.php` lalu diteruskan ke Router.
2. Router mencocokkan path dengan `routes/web.php` (atau `routes/api.php`).
3. Middleware auth/role dijalankan jika dibutuhkan.
4. Controller mempersiapkan data, memanggil view (`views/...`) melalui `layouts/main.php` sehingga navbar dan sidebar otomatis ikut.
5. Asset CSS/JS di `public/assets` menangani tampilan dan interaksi ringan.

## Cara Menjalankan Aplikasi

### Prasyarat
- PHP 8.x terpasang di mesin lokal
- MySQL
  
### Langkah Development
1. Buka terminal PowerShell dan arahkan ke root repo.
2. Masuk ke direktori public:
	```powershell
	cd .\TUBES_PRK_PEMWEB_2025\kelompok\kelompok_25\src\public
	```
3. Jalankan server PHP built-in:
	```powershell
	php -S localhost:8000 index.php
	```
4. Buka `http://localhost:8000` di browser.

## Pengembangan Lanjutan
- Tambahkan halaman baru dengan membuat folder view (`views/<fitur>/index.php`) dan mapping route di `routes/web.php`.
- Integrasikan data nyata dengan membuat model & controller API, kemudian panggil via AJAX dari `public/assets/js/modules/<fitur>.js`.
- Gunakan Tailwind CDN saat prototyping; pindah ke build pipeline (`npm run build`) jika perlu optimisasi produksi.

---
Kelompok 25 – Sistem Informasi Manajemen Stok Bahan Baku
