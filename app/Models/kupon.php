<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_kupon',
        'jenis_diskon',
        'jumlah_diskon',
        'tanggal_kadaluarsa',
        
    ];
}
