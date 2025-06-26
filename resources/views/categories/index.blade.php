@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{$title}}</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td class="d-flex">
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info mr-2">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No categories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $categories->links('pagination::bootstrap-5') }} 
    </div>
@endsection
