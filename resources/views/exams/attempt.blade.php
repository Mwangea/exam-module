@extends('layouts.app')

@section('title', $exam->title)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="POST" action="{{ route('exams.submit', $exam) }}" id="exam-form">
                @csrf

                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-header text-white" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold">{{ $exam->title }}</h4>
                            <div class="text-end">
                                <span class="badge bg-white text-dark" id="exam-timer">
                                    <i class="bi bi-clock me-1"></i>
                                    <span id="time-display">{{ gmdate('H:i:s', $exam->duration * 60) }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-white">Progress: <span id="answered-count">0</span>/{{ $questions->count() }}</small>
                            <small class="text-white">Category: {{ $exam->category }}</small>
                        </div>
                        <div class="progress progress-thin mt-2">
                            <div class="progress-bar bg-white" id="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @foreach($questions as $index => $question)
                            <div class="question-card card mb-4" id="question-{{ $question->id }}">
                                <div class="card-body p-4">
                                    <h5 class="card-title d-flex align-items-center">
                                        <span class="badge bg-light text-dark me-3 px-3 py-2">{{ $index + 1 }}</span>
                                        {{ $question->question_text }}
                                    </h5>

                                    <div class="list-group list-group-flush mt-3">
                                        @foreach($question->answers as $answer)
                                            <label class="list-group-item list-group-item-action rounded-3 mb-2 border">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="answers[{{ $question->id }}]"
                                                        id="answer-{{ $answer->id }}"
                                                        value="{{ $answer->id }}"
                                                        {{ isset($savedAnswers[$question->id]) && $savedAnswers[$question->id] == $answer->id ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="answer-{{ $answer->id }}">
                                                        {{ $answer->answer_text }}
                                                    </label>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer bg-white p-4 border-0">
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="save_progress" value="1" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-save me-1"></i> Save Progress
                            </button>
                            <button type="button" class="btn text-white px-4" style="background-color: var(--primary-color);" data-bs-toggle="modal" data-bs-target="#submitModal">
                                Submit Exam <i class="bi bi-send ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Confirmation Modal -->
                <div class="modal fade" id="submitModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header" style="background-color: var(--secondary-color); color: white;">
                                <h5 class="modal-title">Confirm Submission</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <p>You have answered <span id="modal-answered-count">0</span> out of {{ $questions->count() }} questions.</p>
                                <p>Are you sure you want to submit your exam? You won't be able to make changes after submission.</p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </button>
                                <button type="submit" class="btn text-white" style="background-color: var(--primary-color);">
                                    <i class="bi bi-check-circle me-1"></i> Submit Exam
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Timer functionality
        const examDuration = {{ $exam->duration * 60 }}; // in seconds
        let timeLeft = examDuration;
        const timerElement = document.getElementById('time-display');

        function updateTimer() {
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = timeLeft % 60;

            timerElement.textContent =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft <= 0) {
                document.getElementById('exam-form').submit();
            } else {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            }
        }

        // Progress tracking
        function updateProgress() {
            const answered = document.querySelectorAll('input[type="radio"]:checked').length;
            const total = {{ $questions->count() }};
            const percentage = Math.round((answered / total) * 100);

            document.getElementById('progress-bar').style.width = percentage + '%';
            document.getElementById('answered-count').textContent = answered;
            document.getElementById('modal-answered-count').textContent = answered;

            // Update progress bar color based on completion
            if (percentage < 30) {
                document.getElementById('progress-bar').classList.remove('bg-success', 'bg-warning');
                document.getElementById('progress-bar').classList.add('bg-danger');
            } else if (percentage < 70) {
                document.getElementById('progress-bar').classList.remove('bg-danger', 'bg-success');
                document.getElementById('progress-bar').classList.add('bg-warning');
            } else {
                document.getElementById('progress-bar').classList.remove('bg-danger', 'bg-warning');
                document.getElementById('progress-bar').classList.add('bg-success');
            }
        }

        // Initialize
        updateTimer();
        updateProgress();

        // Update progress when answers are selected
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', updateProgress);
        });
    });
</script>
@endpush
@endsection
