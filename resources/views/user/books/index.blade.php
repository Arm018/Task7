@extends('layouts.header')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Books</h1>
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">
                                <b>About Book: </b>{{ $book->description }}
                            </p>
                            <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $books->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
