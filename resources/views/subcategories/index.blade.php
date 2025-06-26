@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ $title }}</h1>
        <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Create Subcategory</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->category->name }}</td>
                    <td>{{ Str::limit($subcategory->description, 50) }}</td>
                    <td>
                        <a href="{{ route('subcategories.show', $subcategory) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('subcategories.edit', $subcategory) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('subcategories.destroy', $subcategory) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 {{ $subcategories->links('pagination::bootstrap-5') }} 
@endsection