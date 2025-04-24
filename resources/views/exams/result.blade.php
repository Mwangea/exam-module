@extends('layouts.app')

@section('title', 'Exam Results')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Exam Results: {{ $exam->title }}</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <h2 class="display-4 fw-bold {{ $percentage >= 70 ? 'text-success' : ($percentage >= 50 ? 'text-warning' : 'text-danger') }}">
                                        {{ $percentage }}%
                                    </h2>
                                    <p class="mb-0">Overall Score</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Correct Answers:</span>
                                        <span class="fw-bold">{{ $score }}/{{ $totalQuestions }}</span>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ ($score/$totalQuestions)*100 }}%"
                                            aria-valuenow="{{ $score }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $totalQuestions }}">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Incorrect Answers:</span>
                                        <span class="fw-bold">{{ $totalQuestions - $score }}/{{ $totalQuestions }}</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ (($totalQuestions-$score)/$totalQuestions)*100 }}%"
                                            aria-valuenow="{{ $totalQuestions - $score }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $totalQuestions }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Detailed Results</h5>

                    @foreach($results as $result)
                        <div class="card mb-3 {{ $result['is_correct'] ? 'correct-answer' : 'incorrect-answer' }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">Question {{ $loop->iteration }}</h6>
                                    @if($result['is_correct'])
                                        <span class="badge bg-success">Correct</span>
                                    @else
                                        <span class="badge bg-danger">Incorrect</span>
                                    @endif
                                </div>

                                <p class="fw-bold">{{ $result['question']->question_text }}</p>

                                <div class="mb-2">
                                    <p class="mb-1"><strong>Your answer:</strong></p>
                                    <div class="ps-3">
                                        <i class="bi {{ $result['is_correct'] ? 'bi-check-circle text-success' : 'bi-x-circle text-danger' }} me-2"></i>
                                        {{ $result['question']->answers->find($result['user_answer_id'])->answer_text ?? 'No answer provided' }}
                                    </div>
                                </div>

                                @unless($result['is_correct'])
                                    <div class="mb-2">
                                        <p class="mb-1"><strong>Correct answer:</strong></p>
                                        <div class="ps-3">
                                            <i class="bi bi-check-circle text-success me-2"></i>
                                            {{ $result['question']->answers->find($result['correct_answer_id'])->answer_text }}
                                        </div>
                                    </div>
                                @endunless

                                @if($result['question']->explanation)
                                    <div class="alert alert-light mt-2">
                                        <p class="mb-1"><strong>Explanation:</strong></p>
                                        {{ $result['question']->explanation }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('exams.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back to Exams
                        </a>
                        <button class="btn btn-primary" onclick="window.print()">
                            <i class="bi bi-printer me-1"></i> Print Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
