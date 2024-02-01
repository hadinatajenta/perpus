<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::prefix('buku')->group(function(){
    Route::get('/semua-buku',[BukuController::class,'halaman_buku'])->name('buku.view');
    Route::post('/tambah-buku',[BukuController::class,'create_buku'])->name('buku.create');
    Route::put('/edit-buku/{id}',[BukuController::class,'edit_buku'])->name('buku.edit');
    Route::delete('/hapus-buku/{id}',[BukuController::class,'delete'])->name('buku.delete');
});