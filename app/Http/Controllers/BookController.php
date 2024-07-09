<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $data['books'] = Book::with('authors')->paginate(5);
        return view('admin.books.index',$data);
    }

    public function create()
    {
        $data['authors'] = Author::all();
        return view('admin.books.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'authors' => 'required|array'
        ]);

            $book = new Book();
            $book->title =  $request->input('title');
            $book->description = $request->input('description');
            $book->publication_year  = $request->input('publication_year');
            $book->save();

            $book->authors()->attach($request->authors);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

        public function edit($id)
        {
            $data['book'] = Book::find($id);
            $data['authors'] = Author::all();
            return view('admin.books.edit', $data);
        }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'authors' => 'required|array|min:1',
        ]);

        $book = Book::find($id);
        $book->title = $request->title;
        $book->description = $request->description;
        $book->publication_year = $request->publication_year;
        $book->save();
        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->authors()->detach();
        $book->delete();
        return back()->with('success', 'Book deleted successfully.');
    }

    public function userIndex()
    {
        $data['books'] = Book::with('authors')->paginate(5);
        return view('user.books.index', $data);
    }

    public function userShow($id)
    {
        $data['book'] = Book::with('authors')->find($id);
        return view('user.books.show', $data);
    }


}
