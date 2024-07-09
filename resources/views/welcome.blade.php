@extends('layouts.header')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <h1>Welcome to the Bookstore</h1>
                    <div class="list-group mt-4">
                        <a href="{{ route('user.books.index') }}" class="list-group-item list-group-item-action">View Books</a>
                        <a href="{{ route('user.authors.index') }}" class="list-group-item list-group-item-action">View Authors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
