# Aplikasi Manajemen Kegiatan Seminar Nasional Teknologi dan Riset

Aplikasi ini dibuat untuk memanajemen aktivitas pada kegiatan semnastera dan ditujukan untuk salah satu syarat kelulusan program D3 Teknik Komputer di Politeknik Sukabumi.
Dibangun menggunakan Laravel 10 dan Javascript sebagai Add-On atau plugin guna mempercantik tampilan website.

### Requirement

-   Terinstall Node JS https://nodejs.org/en/download
-   Terinstall GIT untuk menjalankan Command git https://git-scm.com/download/win
-   Composer versi up to 2.4 https://getcomposer.org/Composer-Setup.exe
-   PHP minimum versi 8.1
-   Anda bisa menggunakan tools dibawah ini: (Pilih salah satu)

*   XAMPP: https://www.apachefriends.org/download.html
*   LARAGON: https://laragon.org/download/index.html
*   WampServer: https://sourceforge.net/projects/wampserver/

### Instalasi

-   Clone projek ini dengan perintah berikut

```
https://github.com/hariaja/seminar-nasional-teknologi-dan-riset-apps.git
```

-   Buka terminal projek setelah meng-clone, kemudian jalankan perintah dibawah ini

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
npm install
```

```
npm run dev
```

-   Konfigurasi database (MySQL, PosgreSQL dll)
-   Hubungkan database (yang sudah dibuat) dengan projek
-   Kemudian jalankan perintah dibawah ini

```
php artisan migrate:fresh --seed
```

-   Jalankan serve dengan:

```
php artisan serve
```

-   Jika ketika menjalankan projek ada gambar yang tidak muncul, cukup jalankan perintah

```
php artisan storage:link
```

-   LARAVEL DOCUMENTATION: https://laravel.com/docs/10.x
