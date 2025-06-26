@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" 
                        id="category_id" name="category_id">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subcategory_id" class="form-label">Subcategory</label>
                <select class="form-select @error('subcategory_id') is-invalid @enderror" 
                        id="subcategory_id" name="subcategory_id">
                    <option value="">Select a subcategory</option>
                    @if(old('category_id', $post->category_id))
                        @foreach(\App\Models\Subcategory::where('category_id', old('category_id', $post->category_id))->get() as $subcategory)
                            <option value="{{ $subcategory->id }}" 
                                {{ old('subcategory_id', $post->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('subcategory_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                const categoryId = $(this).val();
                const subcategorySelect = $('#subcategory_id');
                const oldSubcategoryId = {{ old('subcategory_id', $post->subcategory_id) ?? 'null' }};

                if (categoryId) {
                    subcategorySelect.prop('disabled', false);
                    subcategorySelect.html('<option value="">Loading...</option>');

                    $.ajax({
                        url: '{{ route("subcategories.by.category") }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(response) {
                            subcategorySelect.empty();
                            subcategorySelect.append('<option value="">Select Subcategory</option>');
                            
                            if (response.length > 0) {
                                $.each(response, function(index, subcategory) {
                                    const option = $('<option></option>')
                                        .val(subcategory.id)
                                        .text(subcategory.name);
                                    
                                    if (subcategory.id == oldSubcategoryId) {
                                        option.prop('selected', true);
                                    }
                                    
                                    subcategorySelect.append(option);
                                });
                            } else {
                                subcategorySelect.append('<option value="">No subcategories found</option>');
                            }
                        },
                        error: function(xhr) {
                            subcategorySelect.html('<option value="">Error loading subcategories</option>');
                            console.error('Error:', xhr.responseText);
                        }
                    });
                } else {
                    subcategorySelect.prop('disabled', true);
                    subcategorySelect.html('<option value="">Select category first</option>');
                }
            });

            // Trigger change if returning with validation errors or on initial load
            @if(old('category_id', $post->category_id))
                $('#category_id').trigger('change');
            @endif
        });
    </script>
    @endpush
@endsection