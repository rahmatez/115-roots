<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'currency',
        'image',
        'external_url',
        'description',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function imageUrl(): string
    {
        if (str_starts_with($this->image, 'frontend/')) {
            return asset($this->image);
        }

        return Storage::url($this->image);
    }

    public function formattedPrice(): string
    {
        return number_format((float) $this->price, 0, '.', ',');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
