<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['title', 'content', 'meta_title', 'meta_description'];

    protected $fillable = [
        'title', 'title_en', 'slug', 'content', 'content_en', 'image',
        'is_active', 'published_at', 'view_count',
        'meta_title', 'meta_title_en', 'meta_description', 'meta_description_en',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image) {
                    return asset('images/placeholder-post.png');
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')->latest();
    }
}
