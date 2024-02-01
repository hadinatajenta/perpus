<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamanController;
use Illuminate\Support\Facades\Route;

Route::prefix('/peminjaman-buku')->group(function(){
    Route::get('/',[PinjamanController::class,'halaman_pinjaman'])->name('pinjaman.view');
});