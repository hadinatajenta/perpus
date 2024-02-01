<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKeye = 'pinjaman_id';
    protected $fillable = [
        'peminjam_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'status'
    ];

    // ke table users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ke table buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);   
    }
}
