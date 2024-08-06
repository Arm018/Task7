<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('admin/login', function () {
    return view('admin.vue-api-login');
})->name('admin.vue-api-login');
Route::post('admin/login', [App\Http\Controllers\Api\AdminController::class, 'login']);


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);

});

Route::get('books', [\App\Http\Controllers\BookController::class, 'index'])->name('user.books.index');
Route::get('books/{id}', [\App\Http\Controllers\BookController::class, 'show'])->name('user.books.show');

Route::get('authors', [\App\Http\Controllers\AuthorController::class, 'index'])->name('user.authors.index');
Route::get('authors/{id}', [\App\Http\Controllers\AuthorController::class, 'show'])->name('user.authors.show');




