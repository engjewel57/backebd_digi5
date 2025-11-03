<?php
// app/Models/EcommerceProcessStep.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceProcessStep extends Model
{
    protected $fillable = [
        'step_number',
        'title',
        'description',
        'gradient',
        'icon_bg',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}