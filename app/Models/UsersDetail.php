<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDetail extends Model
{
    use HasFactory;
    protected $table = 'users_detail';
    protected $fillable = [
        'users_id',
        'nama_belakang',
        'alamat',
        'nomor_telepon',
        'kelas',
        'jurusan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
