@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-primary text-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create New Learning Material</h4>
                        <a href="{{ route('hr.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-muted">Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-heading text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control bg-light border-0 @error('title') is-invalid @enderror" 
                                               name="title" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-muted">Category</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-tag text-primary"></i>
                                        </span>
                                        <select class="form-select bg-light border-0 @error('category_id') is-invalid @enderror" 
                                                name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-muted">Description</label>
                                    <textarea class="form-control bg-light border-0 @error('description') is-invalid @enderror" 
                                              name="description" rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-muted">File Attachment</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-file text-primary"></i>
                                        </span>
                                        <input type="file" class="form-control bg-light border-0 @error('file') is-invalid @enderror" 
                                               name="file">
                                    </div>
                                    @error('file')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-muted">External Link</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-link text-primary"></i>
                                        </span>
                                        <input type="url" class="form-control bg-light border-0 @error('link') is-invalid @enderror" 
                                               name="link" value="{{ old('link') }}">
                                    </div>
                                    @error('link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-muted">Available for Departments</label>
                                    <div class="row g-3">
                                        @foreach($departments as $department)
                                            <div class="col-md-4">
                                                <div class="form-check custom-checkbox">
                                                    <input type="checkbox" class="form-check-input" 
                                                           name="departments[]" value="{{ $department->id }}"
                                                           id="dept{{ $department->id }}">
                                                    <label class="form-check-label" for="dept{{ $department->id }}">
                                                        {{ $department->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-save me-2"></i>Create Material
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-select:focus {
    box-shadow: none;
    border-color: #4a90e2;
}

.input-group-text {
    border-right: none;
}

.form-control, .form-select {
    border-left: none;
}

.btn-primary {
    background: linear-gradient(135deg, #4a90e2 0%, #3273dc 100%);
    border: none;
    transition: transform 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
}

.custom-checkbox .form-check-input:checked {
    background-color: #4a90e2;
    border-color: #4a90e2;
}
</style>
@endsection