@extends('layouts.app')

@section('title', 'Available Exams')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">Available Exams</h4>
                        <form method="GET" action="{{ route('exams.index') }}" class="w-25">
                            <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="all">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if($exams->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-journal-x fs-1 text-muted"></i>
                            <h5 class="mt-3">No exams available</h5>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($exams as $exam)
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm question-card">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h5 class="card-title mb-0 fw-bold">{{ $exam->title }}</h5>
                                                <span class="badge rounded-pill" style="background-color: var(--secondary-color);">{{ $exam->category }}</span>
                                            </div>
                                            <p class="card-text text-muted">{{ Str::limit($exam->description, 100) }}</p>

                                            <div class="d-flex justify-content-between align-items-center mt-4">
                                                <div>
                                                    <span class="badge bg-light text-dark">
                                                        <i class="bi bi-question-circle me-1"></i> {{ $exam->question_count }} questions
                                                    </span>
                                                    <span class="badge bg-light text-dark ms-2">
                                                        <i class="bi bi-clock me-1"></i> {{ $exam->duration }} mins
                                                    </span>
                                                </div>
                                                <a href="{{ route('exams.attempt', $exam) }}" class="btn btn-sm px-3 py-2" style="background-color: var(--primary-color); color: var(--text-light);">
                                                    Start <i class="bi bi-chevron-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
