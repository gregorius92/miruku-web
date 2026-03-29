<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SeoMetaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Share global settings with all views
        $globalSeo = [
            'site_name'        => Setting::get('site_name', 'Miruku'),
            'meta_title'       => Setting::get('meta_title', 'Miruku – Susu Lactose-Free Premium Indonesia'),
            'meta_description' => Setting::get('meta_description', 'Susu lactose-free premium terbaik di Indonesia.'),
            'meta_keywords'    => Setting::get('meta_keywords', 'susu lactose free, susu sehat, miruku'),
            'og_image'         => Setting::get('og_image'),
            'instagram'        => Setting::get('instagram'),
            'tiktok'           => Setting::get('tiktok'),
            'shopee_link'      => Setting::get('shopee_link'),
            'tokopedia_link'   => Setting::get('tokopedia_link'),
            'contact_email'    => Setting::get('contact_email'),
            'contact_phone'    => Setting::get('contact_phone'),
        ];

        View::share('global_seo', $globalSeo);

        return $next($request);
    }
}
