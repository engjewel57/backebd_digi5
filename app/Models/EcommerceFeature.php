<?php
// app/Models/EcommerceFeature.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceFeature extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'gradient',
        'icon_bg',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}