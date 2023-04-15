<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paketLaundry extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_paket',
        'harga_paket',
        'jenis_paket',
    ];
}
