<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('authors')->get();
        return BookResource::collection($books);
    }

    public function create()
    {

    }

    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->fill($request->validated());
        $book->save();
        $book->authors()->attach($request->authors);

        return response()->json([
            'message' => 'Book created successfully.',
            'book' => new BookResource($book)
        ], 201);
    }

    public function show($id)
    {
        $book = Book::with('authors')->findOrFail($id);
        return new BookResource($book);
    }

    public function edit($id)
    {
        $book = Book::with('authors')->findOrFail($id);
        $authors = Author::all();

        return response()->json([
            'book' => new BookResource($book),
            'authors' => $authors
        ]);
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($request->validated());
        $book->save();
        $book->authors()->sync($request->authors);

        return response()->json([
            'message' => 'Book updated successfully.',
            'book' => new BookResource($book)
        ]);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully.'
        ]);
    }
}
