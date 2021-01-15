<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{

    public function index(Request $request, Quiz $quiz)
    {
        $checkResult = Result::where('quiz_id', $quiz->id)->where('user_id', Auth::id())->get();

        if ($request->access_code != $quiz->access_code) {
            return redirect()->back()->with('alert', 'Access code you entered is incorrect!');
        } else if (count($checkResult) > 0) {
            return redirect()->back()->with('alert', 'You have already submitted this quiz!');
        } else {
            $questions = Question::with('answers')->where('quiz_id', $quiz->id)->get();
            return view('quiz/submit_quiz', compact('quiz', 'questions'));
        }
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $user_score = 0;
        $quiz_questions = Question::where('quiz_id', $quiz->id)->get();

        foreach ($request->all() as $key => $value) {

            $question_id = explode('_', $key)[1];
            $question_answers = Answer::where('question_id', $question_id)->get();

            if (gettype($value) == 'string') {
                foreach ($question_answers as $idx => $answer) {
                    if ($answer->is_right == 1 && $value == $idx + 1) {
                        $user_score++;
                    }
                }
            } else if (gettype($value) == 'array') {
                $correct_answers = 0;
                $user_correct_answers = 0;
                foreach ($question_answers as $idx => $answer) {
                    if ($answer->is_right == 1) {
                        $correct_answers++;
                    }
                    if ($answer->is_right == 1 && in_array($idx + 1, $value)) {
                        $user_correct_answers++;
                    }
                }
                if ($correct_answers == $user_correct_answers && $correct_answers == count($value)) {
                    $user_score++;
                }
            }
        }
        $min_limit = 41;
        $max_score = count($quiz_questions);
        $user_percentage = number_format($user_score / $max_score * 100, 2);

        $is_passed = $user_percentage > $min_limit;

        $result = new Result([
            'quiz_id' => $quiz->id,
            'user_score' => $user_score,
            'max_score' => $max_score,
            'user_percentage' => $user_percentage,
            'is_passed' => $is_passed
        ]);

        $result->quiz_id = $quiz->id;
        $result->user_id = Auth::id();

        $result->save();

        return view('result/quiz_result')->with([
            'user_score' => $user_score,
            'max_score' => $max_score,
            'user_percentage' => $user_percentage,
            'is_passed' => $is_passed,
            'min_limit' => $min_limit
        ]);
    }
}
