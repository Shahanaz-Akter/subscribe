<?php

declare(strict_types=1);

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenant\TenancyRegisterController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


// config('tenancy.central_domains')[1];

// All specific Tenants Route id
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
   

// Route::domain('sub domains name')->group(function () { }

Route::get('/', function () {
    return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // dd(tenant('id'));
});

Route::get('/add-blog', [TenancyRegisterController::class, 'addBlog'])->name('add.blog');
Route::post('/post-blog', [TenancyRegisterController::class, 'postBlog'])->name('post.blog');
Route::get('/edit-blog', [TenancyRegisterController::class, 'editBlog'])->name('edit.blog');
Route::get('/delete-blog', [TenancyRegisterController::class, 'deleteBlog'])->name('delete.blog');


});


// Specific Tenants Route
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Each Tenants will have different interface using their individual domains
    Route::domain('abc.localhost')->group(function () {

        Route::get('/dashboard', function () {
            return "Test Tenant Dashboard";
        });

        Route::get('/', function () {
            return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        });

        Route::get('/single-tenant', function () {
            echo "I am from  this id contains " . tenant('id') . "Tenant";
            return view('demo');
        });

        Route::get('/subscription', [TenancyRegisterController::class, 'subscription'])->name('subscription');
        Route::get('/permission-subscription', [TenancyRegisterController::class, 'PermissionSubscription'])->name('permission-subscription');
        Route::get('/first-tenant-blogs', [TenancyRegisterController::class, 'FirstTenantBlogs'])->name('first-tenant');
        Route::get('/show1', [TenancyRegisterController::class, 'show1'])->name('show1');

        Route::get('/abc/blog_edit/{id}', [TenancyRegisterController::class, 'abcBlogEdit'])->name('abc/blog_edit');
        Route::post('/abc/post_abc_blog/{id}', [TenancyRegisterController::class, 'postAbcBlog'])->name('abc/post_abc_blog');
        Route::get('/abc/blog_delete/{id}', [TenancyRegisterController::class, 'abcBlogDelete'])->name('abc/blog_delete');

    });

    Route::domain('mimi.localhost')->group(function () {

        Route::get('/dashboard', function () {
            return "Mimi Tenant Dashboard";
        });

        Route::get('/', function () {
            return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        });

        Route::get('/subscription', [TenancyRegisterController::class, 'subscription'])->name('subscription');
        Route::get('/permission-subscription', [TenancyRegisterController::class, 'PermissionSubscription'])->name('permission-subscription');
        Route::post('/second-tenant-post', [TenancyRegisterController::class, 'SecondTenantPost'])->name('second-tenant-post');
        Route::get('/show2', [TenancyRegisterController::class, 'show2'])->name('show2');

        Route::get('/mimi/blog_edit/{id}', [TenancyRegisterController::class, 'mimiBlogEdit'])->name('mimi.blog_edit');
        Route::post('/mimi/post_mimi_blog/{id}', [TenancyRegisterController::class, 'postMimiBlog'])->name('abc/post_mimi_blog');
        Route::get('/mimi/blog_delete/{id}', [TenancyRegisterController::class, 'mimiBlogDelete'])->name('product.product_delete');

        // post_mimi_blog
        Route::get('/mimi/product_edit/{id}', [TenancyRegisterController::class, 'mimiBlogEdit'])->name('product.product_edit');
        Route::post('/mimi/post_mimi_blog/{id}', [TenancyRegisterController::class, 'postMimiBlog'])->name('post_mimi_blog');
        Route::post('/mimi/post_mimi_product/{id}', [TenancyRegisterController::class, 'postMimiproduct'])->name('post_mimi_product');
        Route::get('/mimi/product_delete/{id}', [TenancyRegisterController::class, 'mimiProductDelete'])->name('product_delete');

    });
});
