<?php


use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('admin/api/login', function () {
    return view('admin.vue-api-login');
})->name('admin.vue-api-login');
Route::post('admin/login', [App\Http\Controllers\Api\AdminController::class, 'login']);


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::view('dashboard','admin.dashboard')->name('admin.dashboard');

});

Route::get('books', [\App\Http\Controllers\BookController::class, 'index'])->name('user.books.index');
Route::get('books/{id}', [\App\Http\Controllers\BookController::class, 'show'])->name('user.books.show');

Route::get('authors', [\App\Http\Controllers\AuthorController::class, 'index'])->name('user.authors.index');
Route::get('authors/{id}', [\App\Http\Controllers\AuthorController::class, 'show'])->name('user.authors.show');

Route::view('admin/books', 'admin.books.index');
Route::view('admin/books/create','admin.books.create');
Route::view('admin/books/{id}/edit','admin.books.edit');

Route::view('admin/authors', 'admin.authors.index');
Route::view('admin/authors/create','admin.authors.create');
Route::view('admin/authors/{id}/edit','admin.authors.edit');

