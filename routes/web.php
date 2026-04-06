<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/benefits-lactose-free', [HomeController::class, 'benefits'])->name('benefits');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index']);

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{post}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
Route::get('/blog', fn() => redirect()->route('articles.index', request()->query()), 301);
Route::get('/blog/{post}', fn($post) => redirect()->route('articles.show', $post), 301);

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/stores', [\App\Http\Controllers\StoreController::class, 'index'])->name('stores.index');

// Newsletter
Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{email}/{token?}', [\App\Http\Controllers\NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

/*
|--------------------------------------------------------------------------
| Sitemap
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', function () {
    return redirect('/sitemap.xml');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/translate', [Admin\TranslationController::class, 'translate'])->name('translate');
    Route::post('/upload-image', [Admin\ImageUploadController::class, 'upload'])->name('upload-image');

    // Products
    Route::resource('products', Admin\ProductController::class);
    Route::resource('variants', Admin\VariantController::class);
    Route::resource('product_units', Admin\ProductUnitController::class);

    // Reviews
    Route::get('reviews', [Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('reviews/{review}/approve', [Admin\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('reviews/{review}/reject', [Admin\ReviewController::class, 'reject'])->name('reviews.reject');
    Route::delete('reviews/{review}', [Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Carousels
    Route::resource('carousels', Admin\CarouselController::class);

    // Store Locations
    Route::resource('stores', Admin\StoreLocationController::class);

    // Articles
    Route::resource('articles', Admin\PostController::class)->parameters(['articles' => 'post']);

    // Sections
    Route::get('sections', [Admin\SectionController::class, 'index'])->name('sections.index');
    Route::get('sections/{section}/edit', [Admin\SectionController::class, 'edit'])->name('sections.edit');
    Route::put('sections/{section}', [Admin\SectionController::class, 'update'])->name('sections.update');

    // Settings
    Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [Admin\SettingController::class, 'update'])->name('settings.update');

    // Newsletter
    Route::get('newsletter', [Admin\NewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('newsletter/{id}', [Admin\NewsletterController::class, 'destroy'])->name('newsletter.destroy');
    Route::post('newsletter/{id}/restore', [Admin\NewsletterController::class, 'restore'])->name('newsletter.restore');
    Route::get('newsletter/broadcast', [Admin\NewsletterController::class, 'broadcast'])->name('newsletter.broadcast');
    Route::post('newsletter/broadcast', [Admin\NewsletterController::class, 'sendBroadcast'])->name('newsletter.send-broadcast');
});
