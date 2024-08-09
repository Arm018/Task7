<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();
        return AuthorResource::collection($authors);
    }

    public function create()
    {

    }

    public function store(AuthorRequest $request)
    {
        $author = new Author();
        $author->fill($request->validated());
        $author->save();

        return response()->json([
            'message' => 'Author created successfully.',
            'author' => new AuthorResource($author)
        ], 201);
    }

    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return new AuthorResource($author);
    }

    public function edit($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return new AuthorResource($author);
    }

    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->fill($request->validated());
        $author->save();

        return response()->json([
            'message' => 'Author updated successfully.',
            'author' => new AuthorResource($author)
        ]);
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully.'
        ]);
    }
}
