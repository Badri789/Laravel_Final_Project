<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSubmissionController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth']) -> group(function () {

    Route::get('/', [QuizController::class, 'userQuizzes'])->name('user-quizzes.all');

    Route::get('/my-quizzes', [QuizController::class, 'userQuizzes'])->name('user-quizzes.all');

    Route::get('/results', [ResultController::class, 'index'])->name('results.all');

    Route::get('/quizzes/{quiz}/submission', [QuizSubmissionController::class, 'index'])->name('quiz.submission');

    Route::get('/quizzes/{quiz}/result', [QuizSubmissionController::class, 'submit'])->name('quiz.submit');

    Route::post('/users/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'is.admin']) -> group(function () {

    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.all');

    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');

    Route::post('/quizzes/save-quiz', [QuizController::class, 'save'])->name('quizzes.save');

    Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');

    Route::put('/quizzes/{quiz}/update', [QuizController::class, 'update'])->name('quizzes.update');

    Route::delete('/quizzes/{quiz}/delete', [QuizController::class, 'delete'])->name('quizzes.delete');

    Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('questions.all');

    Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');

    Route::post('/quizzes/{quiz}/questions/save-question', [QuestionController::class, 'save'])->name('questions.save');

    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');

    Route::put('/questions/{question}/update', [QuestionController::class, 'update'])->name('questions.update');

    Route::delete('/questions/{question}/delete', [QuestionController::class, 'delete'])->name('questions.delete');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.all');

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('/categories/save', [CategoryController::class, 'save'])->name('categories.save');

    Route::delete('/categories/{category}/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
});

Route::get('/users/login', [AuthController::class, 'login'])->name('login');

Route::post('/users/post-login', [AuthController::class, 'postLogin'])->name('post.login');

Route::get('/users/register', [AuthController::class, 'register'])->name("register");

Route::post('/users/post-register', [AuthController::class, 'postRegister'])->name('post.register');



