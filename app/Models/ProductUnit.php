<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;

class ProductUnit extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['name'];

    protected $fillable = ['name', 'name_en', 'slug', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
