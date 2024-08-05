<?php


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

Route::post('admin/login', [AdminController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::post('logout', [AdminController::class, 'logout']);


    Route::get('books', function () {
        return BookResource::collection(Book::paginate(5));
    });

    Route::get('books/{id}', function ($id) {
        return new BookResource(Book::findOrFail($id));
    });

    Route::get('authors', function () {
        return AuthorResource::collection(Author::paginate(5));
    });

    Route::get('authors/{id}', function ($id) {
        $author = Author::with('books')->findOrFail($id);
        return new AuthorResource($author);
    });
});



