@extends('layouts.header')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Authors</h2>
                    </div>
                    <div class="card-body">
                        @if($authors->isEmpty())
                            <p class="text-center">No authors found.</p>
                        @else
                            <ul class="list-group">
                                @foreach($authors as $author)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $author->first_name }} {{ $author->last_name }}</span>
                                        <a href="{{ route('user.authors.show', $author->id) }}" class="btn btn-info btn-sm">View Details</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $authors->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
