# Deploy ke aaPanel (Paket ZIP Siap Upload)

File paket siap upload:
- `undangan-premium-aapanel.zip`

## Langkah upload di VPS aaPanel
1. Login ke aaPanel.
2. Masuk menu **Files** ke folder web root domain (contoh: `/www/wwwroot/domainkamu.com`).
3. Upload file `undangan-premium-aapanel.zip`.
4. Klik kanan file ZIP lalu pilih **Unzip/Extract**.
5. Buat database MySQL di aaPanel.
6. Import `database/schema.sql` lalu `database/dummy_data.sql`.
7. Edit `config/database.php` sesuai host, port, dbname, username, password.
8. (Opsional) Edit `config/config.php` untuk `base_url`, SEO, dan tanggal acara.
9. Pastikan folder `uploads/` writable.
10. Akses domain dan login admin di `/admin/login`.

## Kredensial dummy admin
- Email: `admin@demo.com`
- Password: `password123`

## Jika login admin gagal
Beberapa instalasi lama bisa membawa hash password dummy yang tidak cocok. Jalankan SQL berikut di phpMyAdmin:

```sql
UPDATE users
SET password = '$2y$12$.wCfTofgO6r8EQ1ylQa4fuPL6C0T.Z9KnqcXU5CJpLbXpJ1.ShwR2'
WHERE email = 'admin@demo.com';
```

Lalu login ulang dengan password `password123`.
