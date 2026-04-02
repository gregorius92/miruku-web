<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\HasTranslations;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['name', 'description', 'body', 'meta_title', 'meta_description', 'benefits'];

    protected $fillable = [
        'name', 'slug', 'description', 'body', 'image',
        'price', 'unit', 'variant', 'is_featured', 'is_active',
        'show_on_home', 'is_best_seller',
        'meta_title', 'meta_description',
        'benefits', 'benefits_en',
        'name_en', 'description_en', 'body_en', 'meta_title_en', 'meta_description_en',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'show_on_home' => 'boolean',
        'is_best_seller' => 'boolean',
        'price' => 'decimal:2',
        'benefits' => 'array',
        'benefits_en' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function variantInfo()
    {
        return $this->belongsTo(Variant::class, 'variant', 'slug');
    }

    public function unitInfo()
    {
        return $this->belongsTo(ProductUnit::class, 'unit', 'slug');
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('approved', true);
    }

    public function marketplaces()
    {
        return $this->hasMany(ProductMarketplace::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image) {
                    return asset('images/placeholder-product.png');
                }

                if (str_starts_with($this->image, 'http')) {
                    return $this->image;
                }
                
                if (str_starts_with($this->image, 'images/')) {
                    return asset($this->image);
                }

                return Storage::disk('supabase')->url($this->image);
            }
        );
    }

    public function getAverageRatingAttribute()
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
