<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;
    protected $table = 'kategori_buku';
    protected $fillable =[
        'kategori',
        'jumlah_buku'
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
