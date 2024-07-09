@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Author - {{ $author->first_name }} {{ $author->last_name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('authors.update', $author->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $author->first_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $author->last_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="biography">Biography:</label>
                    <textarea name="biography" id="biography" class="form-control" rows="5" required>{{ old('biography', $author->biography) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Author</button>
            </form>
        </div>
    </div>
@endsection
