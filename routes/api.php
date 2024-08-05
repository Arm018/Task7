<?php


use App\Http\Controllers\Api\ApiAuthorController;
use App\Http\Controllers\Api\ApiBookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/books', [ApiBookController::class, 'index'])->name('api.books.index');
Route::get('/books/{id}', [ApiBookController::class, 'show'])->name('api.books.show');

Route::get('authors', [ApiAuthorController::class, 'index'])->name('api.authors.index');
Route::get('authors/{author}', [ApiAuthorController::class, 'show'])->name('api.authors.show');

