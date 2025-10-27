<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'type',
        'subtitle',
        'price',
        'price_unit',
        'price_period',
        'discount_info',
        'features',
        'is_popular',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'display_order' => 'integer'
    ];
}