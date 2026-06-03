<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProductController;

Auth::routes(['register' => false]);

Route::group(['middleware' => ['is_admin', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class)->except('show');
    Route::resource('gallery_items', GalleryItemController::class)->except('show');
    Route::resource('pages', AdminPageController::class)->only(['index', 'edit', 'update']);
    Route::resource('events', AdminEventController::class)->except('show');
    Route::resource('contact_messages', ContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('contact_messages/{contact_message}/reply', [ContactMessageController::class, 'reply'])->name('contact_messages.reply');
    Route::resource('users', AdminUserController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('blogs', AdminBlogController::class)->except('show');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('blogs/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('blogs/category/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');
Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::get('about-us', [PageController::class, 'about'])->name('about-us');
Route::get('faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('feed', [FeedController::class, 'index'])->name('feed');
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::post('send-email', [ContactController::class, 'sendEmail'])
    ->middleware('throttle:contact')
    ->name('send.email');
