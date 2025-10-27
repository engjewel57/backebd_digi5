<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'unit',
        'is_active',
        'display_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'display_order' => 'integer'
    ];
}