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


Route::apiResource('books', ApiBookController::class)->names([
    'index' => 'api.books.index',
    'store' => 'api.books.store',
    'show' => 'api.books.show',
    'update' => 'api.books.update',
    'destroy' => 'api.books.destroy',
]);

Route::apiResource('authors', ApiAuthorController::class)->names([
    'index' => 'api.authors.index',
    'store' => 'api.authors.store',
    'show' => 'api.authors.show',
    'update' => 'api.authors.update',
    'destroy' => 'api.authors.destroy',
]);

