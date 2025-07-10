<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
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
Route::get('/robots.txt', function () {
    return response()->view('admin.robots')->header('Content-Type', 'text/plain');
});

Route::middleware(['checkcode'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    
    Route::get('/artikel', [PageController::class, 'article'])->name('article');
    Route::get('/artikel/page/{page}', [PageController::class, 'article'])->name('article.page');
    
    Route::get('/kategori/{category}', [PageController::class, 'category'])->name('category');
    Route::get('/kategori/{category}/page/{page}', [PageController::class, 'category'])->name('category.page');
    
    Route::get('/penulis/{username}', [PageController::class, 'author'])->name('author');
    Route::get('/penulis/{username}/page/{page}', [PageController::class, 'author'])->name('author.page');
    
    Route::get('/tag/{tag}', [PageController::class, 'tag'])->name('tag');
    Route::get('/tag/{tag}/page/{page}', [PageController::class, 'tag'])->name('tag.page');
    
    Route::get('page-not-found', [PageController::class, 'notfound'])->name('notfound');

    Route::get('/admin/login', [AdminController::class, 'login'])->name('login');
    Route::post('/admin/login', [AdminController::class, 'loginstore'])->name('login.store');

    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('/sitemap', [SitemapController::class, 'index']);

    Route::get('/{slug}', [PageController::class, 'detail'])->name('detail');

    Route::middleware(['checklogcode'])->group(function () {
        
        Route::get('/admin/setting', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::get('/admin/code', [AdminController::class, 'code'])->name('code');
        Route::post('/admin/code', [AdminController::class, 'codestore'])->name('code.store');
        
        Route::get('/admin/website', [AdminController::class, 'website'])->name('website');
        Route::post('/admin/website', [AdminController::class, 'websitestore'])->name('website.store');
        
    });
});

Route::get('/admin/template', [AdminController::class, 'template'])->name('template');
Route::post('/admin/template', [AdminController::class, 'templatestore'])->name('template.store');

Route::get('/admin/register', [AdminController::class, 'register'])->name('register');
Route::post('/admin/register', [AdminController::class, 'registerstore'])->name('register.store');


