@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Material</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('materials.update', $material->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $material->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id', $material->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="5" required>{{ old('description', $material->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Available for Departments</label>
                            <div class="card card-body bg-light">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="select-all-departments" class="form-check-input">
                                    <label class="form-check-label" for="select-all-departments">Select All</label>
                                </div>
                                <div class="department-list">
                                    @foreach($departments as $department)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input department-checkbox" 
                                                name="departments[]" 
                                                value="{{ $department->id }}" 
                                                id="department-{{ $department->id }}"
                                                {{ in_array($department->id, old('departments', $material->departments->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="department-{{ $department->id }}">
                                                {{ $department->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('departments')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="file">Upload New File (Optional)</label>
                            <div class="custom-file">
                                <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                    id="file" name="file">
                                <small class="form-text text-muted">
                                    Current file: {{ $material->file_path ? basename($material->file_path) : 'No file uploaded' }}
                                </small>
                            </div>
                            @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="link">External Link (Optional)</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                id="link" name="link" value="{{ old('link', $material->link) }}"
                                placeholder="https://example.com">
                            @error('link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group text-end">
                            <a href="{{ route('materials.show', $material->id) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Material</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    $('#description').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('#select-all-departments').change(function() {
        $('.department-checkbox').prop('checked', this.checked);
    });
});
</script>
@endpush
@endsection