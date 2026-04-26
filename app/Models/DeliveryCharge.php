<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    protected $fillable = ['area_name', 'area_key', 'charge', 'is_active', 'sort_order'];

    protected $casts = [
        'charge'    => 'float',
        'is_active' => 'boolean',
        'sort_order'=> 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
