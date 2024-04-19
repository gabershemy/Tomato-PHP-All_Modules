<?php

use Illuminate\Support\Facades\Route;
use Modules\OneTheme\App\Http\Controllers\OneThemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([ 'splade'])->name('home.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/about', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('/faq', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::get('/terms', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
    Route::get('/privacy', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
    Route::get('/returns', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'returns'])->name('returns');
    Route::post('/contact', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'send'])->name('contact');
    Route::post('/contact-form', [\Modules\OneTheme\App\Http\Controllers\HomeController::class, 'form'])->name('form');
});

Route::middleware([ 'splade'])->prefix('shop')->name('shop.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ShopController::class, 'index'])->name('index');
    Route::get('/product/{slug}', [\Modules\OneTheme\App\Http\Controllers\ShopController::class, 'product'])->name('product');
});

Route::middleware([ 'splade'])->prefix('blog')->name('blog.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [\Modules\OneTheme\App\Http\Controllers\BlogController::class, 'post'])->name('post');
});


Route::middleware(['splade', 'auth:accounts'])->name('checkout.')->group(function() {
    Route::get('/checkout', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::post('/checkout', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'submit'])->name('submit');
    Route::get('/checkout/select', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'select'])->name('select');
    Route::post('/checkout/shipping', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'shipping'])->name('shipping');
    Route::post('/checkout/balance', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'balance'])->name('balance');
    Route::get('/checkout/done/{order}', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'done'])->name('done');
});

Route::middleware([ 'splade'])->name('cart.')->group(function() {
    Route::get('/cart', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'cart'])->name('cart');
    Route::post('/cart', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
    Route::post('/cart/options', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'options'])->name('options');
    Route::post('/cart/clear', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'clear'])->name('clear');
    Route::post('/cart/{cart}', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'update'])->name('update');
    Route::delete('/cart/{cart}', [\Modules\OneTheme\App\Http\Controllers\CheckoutController::class, 'destroy'])->name('destroy');
});

Route::middleware([ 'splade'])->name('accounts.')->group(function() {
    Route::get('/login', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'check'])->name('login.check');
    Route::get('/register', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'store'])->name('register.store');
    Route::get('/reset', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'reset'])->name('reset');
    Route::post('/reset', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'password'])->name('reset.submit');
    Route::get('/forget', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'forget'])->name('forget');
    Route::post('/forget', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'email'])->name('forget.email');
    Route::get('/email', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'email'])->name('email');
    Route::get('/otp', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'otp'])->name('otp');
    Route::post('/otp/resend', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'resend'])->name('otp.resend');
    Route::post('/otp', [\Modules\OneTheme\App\Http\Controllers\AuthController::class, 'otpCheck'])->name('otp.check');
});

Route::middleware([ 'splade', 'auth:accounts'])->prefix('profile')->name('profile.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [\Modules\OneTheme\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [\Modules\OneTheme\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
    Route::post('/password', [\Modules\OneTheme\App\Http\Controllers\ProfileController::class, 'password'])->name('password');
    Route::delete('/close', [\Modules\OneTheme\App\Http\Controllers\ProfileController::class, 'close'])->name('close');
    Route::get('/logout', [\Modules\OneTheme\App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');
});

Route::middleware([ 'splade', 'auth:accounts'])->prefix('profile/wishlist')->name('profile.wishlist.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ProfileWishlistController::class, 'index'])->name('index');
    Route::post('/create', [\Modules\OneTheme\App\Http\Controllers\ProfileWishlistController::class, 'store'])->name('store');
    Route::delete('/{wishlist}', [\Modules\OneTheme\App\Http\Controllers\ProfileWishlistController::class, 'destroy'])->name('destroy');
});

Route::middleware([ 'splade', 'auth:accounts'])->prefix('profile/notifications')->name('profile.notifications.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ProfileNotificationsController::class, 'index'])->name('index');
    Route::post('/read', [\Modules\OneTheme\App\Http\Controllers\ProfileNotificationsController::class, 'read'])->name('read');
    Route::delete('/clear', [\Modules\OneTheme\App\Http\Controllers\ProfileNotificationsController::class, 'clearUser'])->name('clear');
    Route::get('/{model}', [\Modules\OneTheme\App\Http\Controllers\ProfileNotificationsController::class, 'show'])->name('show');
    Route::post('/{model}', [\Modules\OneTheme\App\Http\Controllers\ProfileNotificationsController::class, 'readSelected'])->name('read.selected');
    Route::delete('/{model}', [\Modules\OneTheme\App\Http\Controllers\ProfileNotificationsController::class, 'destroy'])->name('destroy');
});

Route::middleware(['splade', 'auth:accounts'])->prefix('profile/address')->name('profile.address.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'index'])->name('index');
    Route::get('/create', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'create'])->name('create');
    Route::post('/create', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'store'])->name('store');
    Route::post('/{address}/select', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'select'])->name('select');
    Route::get('/{address}/show', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'show'])->name('show');
    Route::get('/{address}/edit', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'edit'])->name('edit');
    Route::post('/{address}', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [\Modules\OneTheme\App\Http\Controllers\ProfileAddressController::class, 'destroy'])->name('destroy');
});

Route::middleware([ 'splade', 'auth:accounts'])->prefix('profile/orders')->name('profile.orders.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ProfileOrdersController::class, 'index'])->name('index');
    Route::get('/{order}/show', [\Modules\OneTheme\App\Http\Controllers\ProfileOrdersController::class, 'show'])->name('show');
    Route::get('/{order}/print', [\Modules\OneTheme\App\Http\Controllers\ProfileOrdersController::class, 'print'])->name('print');
    Route::post('/{order}/cancel', [\Modules\OneTheme\App\Http\Controllers\ProfileOrdersController::class, 'cancel'])->name('cancel');
});


Route::middleware([ 'splade', 'auth:accounts'])->prefix('profile/wallet')->name('profile.wallet.')->group(function() {
    Route::get('/', [\Modules\OneTheme\App\Http\Controllers\ProfileWalletController::class, 'index'])->name('index');
    Route::get('/create', [\Modules\OneTheme\App\Http\Controllers\ProfileWalletController::class, 'create'])->name('create');
    Route::post('/create', [\Modules\OneTheme\App\Http\Controllers\ProfileWalletController::class, 'store'])->name('store');
    Route::get('/{wallet}/show', [\Modules\OneTheme\App\Http\Controllers\ProfileWalletController::class, 'show'])->name('show');
    Route::get('/{wallet}/edit', [\Modules\OneTheme\App\Http\Controllers\ProfileWalletController::class, 'edit'])->name('edit');
    Route::post('/{wallet}', [\Modules\OneTheme\App\Http\Controllers\ProfileWalletController::class, 'update'])->name('update');
});


