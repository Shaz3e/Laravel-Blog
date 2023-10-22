<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('category-types', CategoryTypeController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('create-tag', [TagController::class, 'createRecord'])->name('create.tag.ajax');
    Route::resource('tags', TagController::class);
    Route::resource('media-categories', MediaCategoryController::class);
    Route::resource('media', MediaController::class);
    Route::resource('post-statuses', PostStatusController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::post('roles/{id}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.update.permissions');
    Route::resource('permissions', PermissionController::class);
});

require __DIR__.'/auth.php';
