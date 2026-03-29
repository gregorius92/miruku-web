<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class StoreLocation extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['name', 'address', 'city'];

    protected $fillable = [
        'name', 'address', 'city', 'phone', 'map_embed', 'open_time', 'close_time', 'is_active',
        'name_en', 'address_en', 'city_en',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCity($query, $city)
    {
        if ($city && $city !== 'all') {
            return $query->where('city', $city);
        }
        return $query;
    }
}
