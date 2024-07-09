@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Books List</h2>
                    <a href="{{ route('books.create') }}" class="btn btn-primary float-right">Create New Book</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($books->count() > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Publication Year</th>
                                <th>Author</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->description }}</td>
                                    <td>{{ $book->publication_year }}</td>
                                    @foreach($book->authors as $author)

                                    <td>{{ $author->first_name }}</td>
                                    <td>

                                        <a href="{{route('books.edit',['id' => $book->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{route('books.destroy',['id' => $book->id])}}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endforeach

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $books->links() }}
                    @else
                        <div class="alert alert-info">
                            No books found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

