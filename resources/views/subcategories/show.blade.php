@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ $subcategory->name }}</h1>
        <div>
            <a href="{{ route('subcategories.edit', $subcategory) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('subcategories.destroy', $subcategory) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <p><strong>Category:</strong> {{ $subcategory->category->name }}</p>
    <p>{{ $subcategory->description }}</p>

    <h3>Posts</h3>
    @if($subcategory->posts->count() > 0)
        <ul>
            @foreach($subcategory->posts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    @else
        <p>No posts found.</p>
    @endif

    <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Back to Subcategories</a>
@endsection