<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Fix untuk Shared Hosting (tanpa akses terminal)
|--------------------------------------------------------------------------
|
| Potongan kode di bawah akan otomatis membuat symbolic
| link antara "public/storage" dan "storage/app/public" jika belum ada.
|
*/

$publicStorage = __DIR__ . '/storage';
$realStorage    = __DIR__ . '/../storage/app/public';

if (!is_link($publicStorage) && is_dir($realStorage)) {
    @symlink($realStorage, $publicStorage);
}

/*
|--------------------------------------------------------------------------
| Periksa mode maintenance Laravel
|--------------------------------------------------------------------------
|
| Jika aplikasi berada dalam mode maintenance (perintah "down" pernah
| dijalankan), maka file maintenance.php akan dipanggil untuk menampilkan
| halaman pemeliharaan.
|
*/

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Autoload Composer
|--------------------------------------------------------------------------
|
| Composer akan menangani autoload seluruh class PHP yang digunakan oleh
| aplikasi Laravel.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrapping Laravel
|--------------------------------------------------------------------------
|
| Laravel akan melakukan proses bootstrap untuk menyiapkan instance aplikasi.
|
*/

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Tangani request HTTP
|--------------------------------------------------------------------------
|
| Setelah aplikasi di-boot, Laravel akan memproses permintaan HTTP yang
| masuk melalui kernel dan mengembalikan response ke browser.
|
*/

$app->handleRequest(Request::capture());