<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_number', 'card_number', 'name', 'email', 'phone', 'address',
        'membership_type', 'joined_at', 'expires_at', 'status',
    ];

    protected $casts = [
        'joined_at' => 'date',
        'expires_at' => 'date',
    ];
}
