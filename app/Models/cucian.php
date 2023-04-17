<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cucian extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_request',
        'status'
    ];
}
