<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/products')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/about')->setPriority(0.7))
            ->add(Url::create('/benefits')->setPriority(0.7));

        // Add dynamic products
        Product::active()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(
                Url::create("/products/{$product->slug}")
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.8)
            );
        });

        return $sitemap->toResponse(request());
    }
}
