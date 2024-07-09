@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Add New Author</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('authors.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                           value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                           value="{{ old('last_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="biography">Biography:</label>
                    <textarea name="biography" id="biography" class="form-control" rows="5"
                              required>{{ old('biography') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Author</button>
            </form>
        </div>
    </div>
@endsection

