<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable =
    [
        'id_kamar',
        'id_user',
        'name',
        'email',
        'no_hp',
        'jenis_kamar',
        'check_in',
        'durasi',
        'total_harga'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}