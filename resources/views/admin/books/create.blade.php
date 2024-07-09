@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Create New Book</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="publication_year">Publication Year:</label>
                            <input type="number" name="publication_year" id="publication_year" class="form-control" value="{{ old('publication_year') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="authors">Authors:</label>
                            <select name="authors[]" id="authors" class="form-control" >
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Create Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
