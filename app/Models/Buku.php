<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table= 'buku';
    protected $fillable= [
        'buku',
        'pengarang',
        'ISBN',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
    ];

    // Setiap buku mempunyai satu kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class);
    }

    // Setiap buku mempunyai banyak peminjam
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
