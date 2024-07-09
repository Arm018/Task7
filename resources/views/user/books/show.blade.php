@extends('layouts.header')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $book->title }}</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $book->description }}</p>
                        <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
                        <p><strong>Author:</strong>
                        <ul class="list-inline">
                            @foreach($book->authors as $author)
                                <li class="list-inline-item">
                                    <a href="{{ route('user.authors.show', $author->id) }}">{{ $author->first_name }} {{ $author->last_name }}</a>@if(!$loop->last),@endif
                                </li>
                            @endforeach
                        </ul>
                        </p>
                        <a href="{{ route('user.books.index') }}" class="btn btn-primary mt-3">Back to Books</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
