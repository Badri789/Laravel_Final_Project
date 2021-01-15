<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Category;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('categories')->get();
        return view('quiz/quizzes')->with('quizzes', $quizzes);
    }

    public function create()
    {
        $categories = Category::all();
        return view('quiz/create_quiz', compact('categories'));
    }

    public function save(SaveQuizRequest $request)
    {
        $quiz = new Quiz($request->all());
        $quiz->save();
        $quiz->categories()->attach($request->categories);
        return redirect()->route('questions.create', $quiz->id);
    }

    public function edit(Quiz $quiz)
    {
        $categories = Category::all();
        return view('quiz/edit_quiz', compact('quiz', 'categories'));
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->all());
        $quiz->categories()->detach($quiz->categories->pluck('id'));
        $quiz->categories()->attach($request->categories);
        return redirect()->route('quizzes.all');
    }

    public function delete(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.all');
    }

    public function userQuizzes()
    {
        $quizzes = Quiz::with('categories')->get();
        return view('quiz/user_quizzes')->with('quizzes', $quizzes);
    }

}
