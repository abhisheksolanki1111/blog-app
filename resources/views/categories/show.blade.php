@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ $category->name }}</h1>
        <div>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <p>{{ $category->description }}</p>

    <h3>Subcategories</h3>
    @if($category->subcategories->count() > 0)
        <ul>
            @foreach($category->subcategories as $subcategory)
                <li>{{ $subcategory->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No subcategories found.</p>
    @endif

    <h3>Posts</h3>
    @if($category->posts->count() > 0)
        <ul>
            @foreach($category->posts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    @else
        <p>No posts found.</p>
    @endif

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection