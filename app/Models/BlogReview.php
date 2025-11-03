<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogReview extends Model
{
    protected $fillable = [
        'name',
        'role',
        'avatar',
        'review',
        'rating',
        'is_active',
        'display_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer'
    ];
}