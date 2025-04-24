<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Module - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3a5a96;
            --secondary-color: #4a7ab6;
            --accent-color: #f8f9fa;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --text-light: #f8f9fa;
            --text-dark: #343a40;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        }

        .progress-thin {
            height: 5px;
        }

        .question-card {
            transition: all 0.3s ease;
            border-radius: 8px;
            border-top: 4px solid var(--secondary-color);
        }

        .question-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .correct-answer {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid var(--success-color);
        }

        .incorrect-answer {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid var(--danger-color);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .badge {
            font-weight: 500;
        }

        footer {
            background-color: var(--accent-color);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('exams.index') }}">
                <i class="bi bi-journal-bookmark me-2"></i> Exam Module
            </a>
            <div class="d-flex">
                <span class="navbar-text text-white">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Guest' }}
                </span>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if(session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-2"></i> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-4 mt-5 border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 text-muted">&copy; {{ date('Y') }} ExamModule. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="badge bg-secondary text-light px-3 py-2">
                        <i class="bi bi-git me-1"></i> v1.0.0
                    </span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
