<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('authors')->paginate(5);
        return view('user.books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with('authors')->find($id);
        return view('user.books.show', compact('book'));
    }
}
