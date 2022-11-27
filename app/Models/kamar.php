<?php

namespace App\Models;   

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    protected $fillable =[
        'nama_hotel','jenis_kamar','tipe_bed','harga_kamar','deskripsi_kamar'
    ];

    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }
}
