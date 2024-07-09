@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Authors</h3>
            <a href="{{ route('authors.create') }}" class="btn btn-primary float-right">Add New Author</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Biography</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->first_name }}</td>
                        <td>{{ $author->last_name }}</td>
                        <td>{{ $author->biography }}</td>
                        <td>
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="mt-1" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $authors->links('pagination::bootstrap-4') }}
                </div>
        </div>
    </div>
@endsection
