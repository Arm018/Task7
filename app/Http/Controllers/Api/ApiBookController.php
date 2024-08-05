<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::query()->with('authors')->paginate(5);
        return response()->json($books);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::query()->findOrFail($id);
        return response()->json($book);
    }


}
