<?php
// app/Models/EcommerceHeroSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceHeroSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'cta1_text',
        'cta2_text',
        'stats',
        'is_active'
    ];

    protected $casts = [
        'stats' => 'array',
        'is_active' => 'boolean'
    ];
}