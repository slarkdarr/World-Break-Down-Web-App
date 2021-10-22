# World Break Down Web App

## Description


## Prerequisites
- nginx / apache
- php 8.0
- sqlite php extension enabled
- php pdo

## Menjalankan server
- Jalankan nginx atau apache
- Jalankan perintah berikut pada root directory, port 8080 dapat diganti sesuai kondisi
`php -S localhost:8080`
- Pada browser buka `localhost:8080` atau port yang sesuai

## Keterangan tambahan

### File tambahan (diluar aplikasi / sebagai developer)
- seeder.php digunakan untuk menginput data dummy
- database/initDb.php digunakan untuk melakukan drop tables kemudian input tables (users, products, histories). Ini juga melakukan input data admin dan user dummy.
- Berikut akun yang dapat digunakan diawal :
username : admin  password : admin123 
username : user password : user123 


### Buatlah file README yang berisi:
    * Deskripsi aplikasi web
    * Daftar requirement
    * Cara instalasi
    * Cara menjalankan server
    * Screenshot tampilan aplikasi (tidak perlu semua kasus, minimal 1 per halaman), dan 
    * Penjelasan mengenai pembagian tugas masing-masing anggota (lihat formatnya pada bagian pembagian tugas).


