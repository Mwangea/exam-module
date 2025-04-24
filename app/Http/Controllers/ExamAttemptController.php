<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExamAttemptController extends Controller
{
    public function show(Exam $exam)
    {
        if (!Session::has('exam_started.'.$exam->id)) {
            Session::put('exam_started.'.$exam->id, now());
            Session::put('exam_answers.'.$exam->id, []);
        }

        $savedAnswers = Session::get('exam_answers.'.$exam->id, []);
        $questions = $exam->questions()->with('answers')->get();

        return view('exams.attempt', compact('exam', 'questions', 'savedAnswers'));
    }

    public function store(Request $request, Exam $exam)
    {
        if ($request->has('save_progress')) {
            Session::put('exam_answers.'.$exam->id, $request->answers ?? []);
            return back()->with('status', 'Your progress has been saved!');
        }

        $score = 0;
        $totalQuestions = $exam->questions()->count();
        $results = [];

        foreach ($exam->questions as $question) {
            $userAnswerId = $request->input('answers.'.$question->id);
            $correctAnswerId = $question->correctAnswer->id;

            $isCorrect = ($userAnswerId == $correctAnswerId);
            if ($isCorrect) {
                $score++;
            }

            $results[] = [
                'question' => $question,
                'user_answer_id' => $userAnswerId,
                'correct_answer_id' => $correctAnswerId,
                'is_correct' => $isCorrect
            ];
        }

        $percentage = round(($score / $totalQuestions) * 100, 2);
        Session::forget('exam_started.'.$exam->id);
        Session::forget('exam_answers.'.$exam->id);

        return view('exams.result', [
            'exam' => $exam,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'percentage' => $percentage,
            'results' => $results
        ]);
    }
}
