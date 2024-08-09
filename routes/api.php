<?php


use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
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






Route::middleware('auth:sanctum')->group(function () {

    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);

    Route::get('admin', [AdminController::class, 'getAdmin']);

});



