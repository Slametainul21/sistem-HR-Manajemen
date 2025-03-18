@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $material->title }}</h4>
                    <div>
                        @if(auth()->user()->isHR())
                            <a href="{{ route('hr.index') }}" class="btn btn-secondary btn-sm">Back</a>
                            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @else
                            <a href="{{ route('employee.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Category</h5>
                        <p>{{ $material->category->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <div>{!! $material->description !!}</div>
                    </div>

                    <div class="mb-4">
                        <h5>Available for Departments</h5>
                        <ul class="list-unstyled">
                            @foreach($material->departments as $department)
                                <li>{{ $department->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @if($material->file_path)
                        <div class="mb-4">
                            <h5>Attached File</h5>
                            <a href="{{ route('materials.download', $material->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i> Download File
                            </a>
                        </div>
                    @endif

                    @if($material->link)
                        <div class="mb-4">
                            <h5>External Link</h5>
                            <a href="{{ $material->link }}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-external-link-alt"></i> Visit Link
                            </a>
                        </div>
                    @endif

                    <div class="mt-4 text-muted">
                        <p>
                            Uploaded by: {{ $material->uploader->name }} <br>
                            Views: {{ $material->views }} <br>
                            Created: {{ $material->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Remove the duplicate back button at the bottom -->
@endsection