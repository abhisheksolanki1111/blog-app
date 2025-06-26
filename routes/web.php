<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Categories Resource
Route::resource('categories', CategoryController::class);

// Subcategories Resource
Route::resource('subcategories', SubcategoryController::class);

// Posts Resource
Route::resource('posts', PostController::class);

Route::get('/subcategories-by-category', [SubcategoryController::class, 'getByCategory'])
    ->name('subcategories.by.category');