<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pelanggan',
        'tanggal_pesan',
        'jumlah_barang',
        'total_biaya',
        'status_pesanan',
        'pakai_kupon', 'id_request'
    ];
}
