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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::query()->with('books')->findOrFail($id);
        return response()->json($author);
    }

}
