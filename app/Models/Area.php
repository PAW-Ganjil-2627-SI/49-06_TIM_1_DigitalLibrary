<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['kode_area', 'jenis', 'nomor_lantai', 'stopkontak', 'wifi', 'status'];

    protected $casts = [
        'stopkontak' => 'boolean',
        'wifi' => 'boolean',
    ];
}