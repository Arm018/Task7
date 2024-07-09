<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('login', [AdminController::class, 'login'])->name('admin.login');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('books')->group(function () {
        Route::get('index', [BookController::class, 'index'])->name('books.index');
        Route::get('create', [BookController::class, 'create'])->name('books.create');
        Route::post('/', [BookController::class, 'store'])->name('books.store');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::put('edit/{id}', [BookController::class, 'update'])->name('books.update');
        Route::delete('delete/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    });

    Route::prefix('authors')->group(function () {
        Route::get('index',[AuthorController::class, 'index'])->name('authors.index');
        Route::get('create',[AuthorController::class, 'create'])->name('authors.create');
        Route::post('/',[AuthorController::class, 'store'])->name('authors.store');
        Route::get('edit/{id}',[AuthorController::class, 'edit'])->name('authors.edit');
        Route::put('edit/{id}',[AuthorController::class, 'update'])->name('authors.update');
        Route::delete('delete/{id}',[AuthorController::class, 'destroy'])->name('authors.destroy');


    });
});

Route::get('books', [BookController::class, 'userIndex'])->name('user.books.index');
Route::get('books/{id}', [BookController::class, 'userShow'])->name('user.books.show');

Route::get('authors', [AuthorController::class, 'userIndex'])->name('user.authors.index');
Route::get('authors/{id}', [AuthorController::class, 'userShow'])->name('user.authors.show');


