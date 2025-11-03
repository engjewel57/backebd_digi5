<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category_id',
        'author',
        'image_url',
        'read_time',
        'featured',
        'is_active',
        'display_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'sections',
        'key_points',
        'tips',
        'cta_title',
        'cta_button_text',
        'cta_button_link'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'sections' => 'array',
        'key_points' => 'array',
        'tips' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}