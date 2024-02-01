<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::prefix('/kategori')->group(function(){
    Route::get('/semua-kategori', [KategoriController::class, 'kategori'])->name('kategori.view');
    Route::post('/tambah-kategori',[KategoriController::class,'create_kategori'])->name('kategori.create');
    Route::put('/edit-kategori/{id}',[KategoriController::class,'edit_kategori'])->name('kategori.edit');
    Route::delete('/delete-kategori/{id}',[KategoriController::class,'delete_kategori'])->name('kategori.delete');
});