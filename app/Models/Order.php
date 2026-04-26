<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'address', 'city',
        'delivery_charge', 'subtotal', 'discount', 'total',
        'payment_method', 'payment_number', 'transaction_id',
        'status', 'coupon_code', 'notes',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_name', 'quantity',
        'unit_price', 'original_price', 'line_total',
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
