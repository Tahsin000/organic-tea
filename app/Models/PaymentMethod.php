<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name', 'key', 'description',
        'requires_transaction', 'payment_number',
        'icon', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'requires_transaction' => 'boolean',
        'is_active'            => 'boolean',
        'sort_order'           => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Returns the structured array used by the frontend.
     */
    public function toFrontendArray(): array
    {
        return [
            'id'                   => $this->key,
            'name'                 => $this->name,
            'desc'                 => $this->description,
            'requires_transaction' => $this->requires_transaction,
            'payment_number'       => $this->payment_number,
            'icon'                 => $this->icon,
        ];
    }
}
