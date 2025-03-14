<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\TabelController;

Route::get('/file/{filename}', function ($filename) {
    $path = "/home/timccmyi/node_js/uploads/$filename"; // Sesuaikan path-nya

    if (!file_exists($path)) {
        abort(404); // Jika file tidak ditemukan, tampilkan error 404
    }

    return Response::file($path);
})->name('file.view');

Route::resource('/', WhatsAppController::class);
Route::resource('/pengaduan', TabelController::class);


