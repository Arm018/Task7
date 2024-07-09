@extends('layouts.app')

@section('content')
    <h2>Admin Dashboard</h2>
    <div class="card">
        <div class="card-body">
            @foreach($admins as $admin)
            <h5 class="card-title">Welcome, {{$admin->name}}!</h5>
            <p class="card-text">This is your dashboard where you can manage the application.</p>
            @endforeach
        </div>
        <div class="card-body d-flex justify-content-end">
            <div class="mr-2">
                <a class="btn btn-outline-success" href="{{ route('books.index') }}">Manage Books</a>
            </div>
            <div>
                <a class="btn btn-outline-success" href="{{route('authors.index')}}">Manage Authors</a>
            </div>
        </div>

    </div>
@endsection
