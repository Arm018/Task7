<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $data['authors'] = Author::all();
        return view('admin.authors.index', $data);
    }
    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'biography' => 'required',
        ]);

        $author = new Author();
        $author->first_name = $request->input('first_name');
        $author->last_name = $request->input('last_name');
        $author->biography = $request->input('biography');
        $author->save();
        return redirect()->route('authors.index')->with('success', 'Author created successfully');

    }
    public function edit($id)
    {
        $data['author'] = Author::find($id);
        return view('admin.authors.edit', $data);

    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'biography' => 'required',
        ]);
        $author = Author::find($id);
        $author->first_name = $request->input('first_name');
        $author->last_name = $request->input('last_name');
        $author->biography = $request->input('biography');
        $author->save();
        return redirect()->route('authors.index')->with('success', 'Author updated successfully');


    }
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully');

    }

    public function userIndex()
    {
        $data['authors'] = Author::with('books')->paginate(5);
        return view('user.authors.index', $data);
    }

    public function userShow($id)
    {
        $data['author'] = Author::with('books')->findOrFail($id);
        return view('user.authors.show', $data);
    }



}
