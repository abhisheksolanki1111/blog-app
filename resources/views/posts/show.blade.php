@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ $post->title }}</h1>
        <div>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <p><strong>Category:</strong> {{ $post->category->name }}</p>
    <p><strong>Subcategory:</strong> {{ $post->subcategory->name }}</p>
    <p><strong>Created:</strong> {{ $post->created_at->format('M d, Y') }}</p>

    <div class="card mt-4">
        <div class="card-body">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
@endsection