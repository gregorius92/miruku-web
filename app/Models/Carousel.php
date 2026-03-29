<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\HasTranslations;

class Carousel extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['title', 'subtitle', 'button_text', 'button2_text'];

    protected $fillable = [
        'title', 'subtitle', 'image', 'button_text', 'button_link',
        'button2_text', 'button2_link', 'text_color', 'order', 'is_active',
        'title_en', 'subtitle_en', 'button_text_en', 'button2_text_en',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image) {
                    return asset('images/hero-default.jpg');
                }

                if (str_starts_with($this->image, 'http')) {
                    return $this->image;
                }
                
                if (str_starts_with($this->image, 'images/')) {
                    return asset($this->image);
                }

                return asset('storage/' . $this->image);
            }
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
