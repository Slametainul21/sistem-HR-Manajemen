@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg rounded-lg">
                    <div class="card-header bg-primary text-white p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $material->title }}</h4>
                            <div>
                                @if (auth()->user()->isHR())
                                    <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-light btn-sm me-2">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('hr.index') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-arrow-left me-2"></i>Back
                                    </a>
                                @else
                                    <a href="{{ route('employee.index') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-arrow-left me-2"></i>Back
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h5 class="text-muted mb-3">Description</h5>
                                    <div class="bg-light p-3 rounded">{!! $material->description !!}</div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="text-muted mb-3">Available for Departments</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($material->departments as $department)
                                            <span class="badge bg-info-subtle text-info">
                                                <i class="fas fa-building me-1"></i>{{ $department->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="text-muted mb-3">Feedback</h5>
                                    <form action="{{ route('feedbacks.store', $material->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea name="content" class="form-control" rows="3" placeholder="Tulis feedback Anda..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim Feedback
                                        </button>
                                    </form>
                                </div>

                                @if ($material->feedbacks->count() > 0)
                                    <div class="mb-4">
                                        <h5 class="text-muted mb-3">Feedback yang Diterima</h5>
                                        <ul class="list-group">
                                            @foreach ($material->feedbacks as $feedback)
                                                <li class="list-group-item">
                                                    <strong>{{ $feedback->user->name }}</strong> -
                                                    <small
                                                        class="text-muted">{{ \Carbon\Carbon::parse($feedback->created_at)->locale('id')->translatedFormat('j F Y H:i') }}</small>
                                                    <p class="mb-0">{{ $feedback->content }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>



                            <div class="col-md-4">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h6 class="text-muted mb-2">Category</h6>
                                            <span class="badge bg-primary">
                                                <i class="fas fa-tag me-1"></i>{{ $material->category->name }}
                                            </span>
                                        </div>

                                        <div class="mb-4">
                                            <h6 class="text-muted mb-2">Uploaded by</h6>
                                            <p class="mb-0">
                                                <i class="fas fa-user me-1"></i>
                                                {{ $material->uploader->name }}
                                            </p>
                                        </div>

                                        <div class="mb-4">
                                            <h6 class="text-muted mb-2">Created</h6>
                                            <p class="mb-0">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($material->created_at)->locale('id')->translatedFormat('j F Y H:i') }}
                                            </p>
                                        </div>

                                        <div class="mb-4">
                                            <h6 class="text-muted mb-2">Views</h6>
                                            <p class="mb-0">
                                                <i class="fas fa-eye me-1"></i>
                                                {{ number_format($material->views, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        @if ($material->file_path)
                                            <div class="mb-4">
                                                <h6 class="text-muted mb-2">Attachment</h6>
                                                <a href="{{ route('materials.download', $material->id) }}"
                                                    class="btn btn-outline-primary btn-sm w-100">
                                                    <i class="fas fa-download me-2"></i>Download File
                                                </a>
                                            </div>
                                        @endif

                                        @if ($material->link)
                                            <div>
                                                <h6 class="text-muted mb-2">External Link</h6>
                                                <a href="{{ $material->link }}"
                                                    class="btn btn-outline-primary btn-sm w-100" target="_blank">
                                                    <i class="fas fa-external-link-alt me-2"></i>Visit Link
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .btn-outline-primary {
            border-color: #4a90e2;
            color: #4a90e2;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #4a90e2 0%, #3273dc 100%);
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }

        .card {
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .bg-info-subtle {
            background-color: rgba(13, 202, 240, 0.1);
        }
    </style>
@endsection
