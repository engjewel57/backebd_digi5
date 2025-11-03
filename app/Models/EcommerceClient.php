<?php
// app/Models/EcommerceClient.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceClient extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}