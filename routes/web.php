<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamAttemptController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExamController::class, 'index'])->name('exams.index');
Route::get('/exams/{exam}', [ExamAttemptController::class, 'show'])->name('exams.attempt');
Route::post('/exams/{exam}', [ExamAttemptController::class, 'store'])->name('exams.submit');

