<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->paginate(5);
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(AuthorRequest $request)
    {

        $author = new Author();
        $author->fill($request->validated());
        $author->save();
        return redirect()->route('authors.index')->with('success', 'Author created successfully');

    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));

    }

    public function update(AuthorRequest $request, $id)
    {

        $author = Author::findOrFail($id);
        $author->fill($request->validated());
        $author->save();
        return redirect()->route('authors.index')->with('success', 'Author updated successfully');

    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully');

    }


}
