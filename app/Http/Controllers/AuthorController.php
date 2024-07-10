<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->paginate(5);
        return view('user.authors.index', compact('authors'));
    }

    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return view('user.authors.show', compact('author'));
    }
}
