<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/test', [SiteController::class, 'test'])->name('test');


Route::get('/categories/{slug}', [SiteController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [SiteController::class, 'product'])->name('shop.product');
Route::get('/product/id/{id}', [SiteController::class, 'product'])->name('shop.product.id');

//products
Route::get('/products', [SiteController::class, 'products'])->name('shop.products_get');
Route::post('/products', [SiteController::class, 'products'])->name('shop.products');
Route::post('/quick-view', [SiteController::class, 'quickView'])->name('quickView');

Route::get('/wishlist', [SiteController::class, 'wishlist'])->name('shop.wishlist');
Route::get('/compare', [SiteController::class, 'compare'])->name('shop.compare');
Route::post('/compare-products', [SiteController::class, 'compareProducts'])->name('compareProducts');

// cart and checkout
Route::get('/cart', [SiteController::class, 'cart'])->name('shop.cart');
Route::post('/coupon', [SiteController::class, 'coupon'])->name('shop.coupon');
Route::get('/checkout', [SiteController::class, 'checkout'])->name('shop.checkout');
Route::post('/place-order', [SiteController::class, 'placeOrder'])->name('shop.placeOrder');
Route::get('/invoice/{invoice_code}', [SiteController::class, 'invoice'])->name('shop.invoice');

//search
Route::get('/search', [SiteController::class, 'search'])->name('search');

Route::get('/page/{slug}', [SiteController::class, 'page'])->name('page');
Route::get('/contact-us', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact-us', [SiteController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
