<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requestBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user', 'status', 'jenis_servis', 'jenis_paket', 'jumlah_barang'
    ];
}
