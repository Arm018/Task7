<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class ApiAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::query()->with('books')->paginate(5);
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = Author::query()->create([$request->all()]);
        return response()->json($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::query()->with('books')->findOrFail($id);
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::query()->findOrFail($id);
        $author->update($request->all());
        return response()->json(['message' => 'Author updated successfully', 'author' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::query()->findOrFail($id);
        $author->delete();
        return response()->json(['message' => 'Author deleted successfully']);

    }
}
