<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanComparison extends Model
{
    protected $fillable = [
        'feature_name',
        'starter_value',
        'professional_value',
        'enterprise_value'
    ];
}