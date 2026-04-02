<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMarketplace extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'url', 'color'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
