@extends('layouts.header')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Author: {{ $author->first_name }} {{ $author->last_name }}</h2>
                    </div>
                    <div class="card-body">
                        <p><b>Biography:</b> {{ $author->biography }}</p>
                        <p><strong>Books:</strong></p>
                        <ul class="list-group">
                            @foreach($author->books as $book)
                                <li class="list-group-item">
                                    <a href="{{ route('user.books.show', $book->id) }}">{{ $book->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('user.authors.index') }}" class="btn btn-primary mt-3">Back to Authors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
