<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;
use Illuminate\Support\Facades\Storage;

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
        return $this->image ? Storage::disk('supabase')->url($this->image) : null;
    }

    public static function getByName($name)
    {
        return static::where('section_name', $name)->first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function features()
    {
        return $this->hasMany(Feature::class)->orderBy('order');
    }

    public function getYoutubeEmbedUrlAttribute()
    {
        $url = $this->getRawOriginal('content');
        if (!$url) return null;

        // Try to extract YouTube Video ID
        $youtubeId = null;
        
        // Pattern for different YouTube URL formats
        $patterns = [
            '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/',
            '/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([a-zA-Z0-9_-]{11})/',
            '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $youtubeId = $matches[1];
                break;
            }
        }

        if ($youtubeId) {
            return "https://www.youtube.com/embed/{$youtubeId}";
        }

        // If no ID found but looks like embed code, or already is an embed URL
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        return null;
    }
}
