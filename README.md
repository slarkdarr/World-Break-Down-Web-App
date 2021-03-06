# World Break Down Web App

## Description
Sebuah aplikasi e-commerce sederhana menjual varian dorayaki

## Prerequisites
- nginx / apache
- php 8.x
- sqlite php extension enabled
- php pdo

## Menjalankan server
- Jalankan nginx atau apache
- Jalankan perintah berikut pada root directory, port 8080 dapat diganti sesuai kondisi
`php -S localhost:8080`
- Pada browser buka `localhost:8080` atau port yang sesuai

## Menjalankan docker
- Pada working directory jalankan `docker compose up -d` dan buka pada browser `localhost:8000`

## Keterangan tambahan

### File tambahan (diluar aplikasi / sebagai developer)
- seeder.php digunakan untuk menginput data dummy
- database/initDb.php digunakan untuk melakukan drop tables kemudian input tables (users, products, histories). Ini juga melakukan input data admin dan user dummy.
- Berikut akun yang dapat digunakan diawal :
    * username : admin  password : admin123
    * username : user password : user123 


### Screenshot
- Register
![Register Desktop](./screenshots/Register_Desktop.png)
![Register Responsive](./screenshots/Register_800x600.png)

- Login
![Login Desktop](./screenshots/Login_Desktop.png)
![Login Responsive](./screenshots/Login_800x600.png)

- Dashboard

![DashboardTop Desktop](./screenshots/DashboardTop_Desktop.png)
![DashboardTop 800x600](./screenshots/DashboardTop_800x600.png)
![DashboardBottom Desktop](./screenshots/DashboardBottom_Desktop.png)
![DashboardBottom 800x600](./screenshots/DashboardBottom_800x600.png)

- Pencarian
![Search Desktop](./screenshots/Search_Desktop.png)

- Penambahan Dorayaki
![AddDorayaki Desktop](./screenshots/AddDorayaki_Desktop.png)
![AddDorayaki 800x600](./screenshots/AddDorayaki_800x600.png)

- Edit dorayaki
![EditStock Desktop](./screenshots/EditStock_Desktop.png)

- Detail Dorayaki
![DetailProduct Desktop](./screenshots/DetailProduct_Desktop.png)
![DetailProduct 800x600](./screenshots/DetailProduct_800x600.png)

- Pengubahan/Pembelian Dorayaki
![ChangeStock Desktop](./screenshots/ChangeStock_Desktop.png)
![BuyDorayaki Desktop](./screenshots/BuyDorayaki_Desktop.png)
![ChangeStock 800x600](./screenshots/ChangeStock_800x600.png)
![BuyDorayaki 800x600](./screenshots/BuyDorayaki_800x600.png)

- Riwayat Pengubahan/Pembelian
![History Desktop](./screenshots/History_Desktop.png)
![History 800x600](./screenshots/History_800x600.png)

- Delete dorayaki
![DeleteProduct Desktop](./screenshots/DeleteProduct_Desktop.png)

### Pembagian Tugas
- Server-side
    * Model & Database : 13519197
    * Login : 13519197
    * Register : 13519197, 13519107
    * Dashboard : 13519197
    * Pencarian : 13519197
    * Penambahan Dorayaki : 13519197
    * Edit dorayaki : 13519197
    * Detail Dorayaki : 13519107
    * Pengubahan/Pembelian Dorayaki : 13519107
    * Expire-time : 13519197
    * Docker : 13519197
    * Riwayat Pengubahan/Pembelian : 13519107
    * Delete dorayaki : 13519197

- Client-side
    * Login : 13519065
    * Register : 13519107
    * Dashboard : 13519197
    * Pencarian : 13519065, 13519197
    * Penambahan Dorayaki : 13519197
    * Edit dorayaki : 13519197
    * Detail Dorayaki : 13519065
    * Pengubahan/Pembelian Dorayaki : 13519107
    * Riwayat Pengubahan/Pembelian : 13519065

### Bonus
- Edit product
- Riwayat
- Docker
- Token
- Responsive design

### Buatlah file README yang berisi:
    * Deskripsi aplikasi web
    * Daftar requirement
    * Cara instalasi
    * Cara menjalankan server
    * Screenshot tampilan aplikasi (tidak perlu semua kasus, minimal 1 per halaman), dan 
    * Penjelasan mengenai pembagian tugas masing-masing anggota (lihat formatnya pada bagian pembagian tugas).


