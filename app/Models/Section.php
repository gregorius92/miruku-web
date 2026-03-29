<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['title', 'subtitle', 'content'];

    protected $fillable = [
        'section_name', 'title', 'subtitle', 'content', 'image', 'order', 'is_active',
        'title_en', 'subtitle_en', 'content_en',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public static function getByName($name)
    {
        return static::where('section_name', $name)->first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
