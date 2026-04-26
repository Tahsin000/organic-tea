<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'product_id', 'name', 'location', 'initial',
        'image', 'text', 'stars', 'status',
    ];

    protected $casts = [
        'stars'      => 'integer',
        'status'     => 'boolean',
        'product_id' => 'integer',
    ];

    protected $appends = ['image_url'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return ImageService::url($this->image);
    }
}
