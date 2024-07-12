<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;


class BookController extends Controller
{

    public function index()
    {
        $books = Book::with('authors')->paginate(5);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

    public function store(BookRequest $request)
    {

        $book = new Book();
        $book->fill($request->validated());
        $book->save();
        $book->authors()->attach($request->authors);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($request->validated());
        $book->save();
        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return back()->with('success', 'Book deleted successfully.');
    }


}
