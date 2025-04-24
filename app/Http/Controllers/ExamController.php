<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $query = Exam::withCount('questions');

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $exams = $query->get();
        $categories = Exam::getCategories();

        return view('exams.index', compact('exams', 'categories'));
    }
}
