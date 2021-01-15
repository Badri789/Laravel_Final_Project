<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = Question::with('answers')->where('quiz_id', $quiz->id)->get();
        return view('question/questions', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('question/create_question')->with('quiz', $quiz);
    }

    public function save(SaveQuestionRequest $request, Quiz $quiz)
    {
        $question = new Question($request->all());
        $question->quiz_id = $quiz->id;
        $question->save();

        $is_multiple_choice = $request->is_multiple_choice;

        foreach ($request->answers as $key => $value) {
            $answer_number = ++$key;
            if ($is_multiple_choice === '0') {
                $answer = new Answer([
                    'answer_body' => $value,
                    'is_right' => $request->right_answer == $answer_number,
                ]);
            } else {
                $answer = new Answer([
                    'answer_body' => $value,
                    'is_right' => in_array($answer_number, $request->right_answers)
                ]);
            }
            $answer->question_id = $question->id;
            $answer->save();
        }
        return redirect()->route('questions.all', $quiz->id);
    }

    public function edit(Question $question)
    {
        $question_answer = Question::with('answers')
            ->where('id', $question->id)->get()->first();

        return view('question/edit_question')->with('question', $question_answer);
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->all());
        $question->save();
        $question->answers()->delete();

        $is_multiple_choice = $request->is_multiple_choice;

        foreach ($request->answers as $key => $value) {
            $answer_number = ++$key;
            if ($is_multiple_choice === '0') {
                $answer = new Answer([
                    'answer_body' => $value,
                    'is_right' => $request->right_answer == $answer_number,
                ]);
            } else {
                $answer = new Answer([
                    'answer_body' => $value,
                    'is_right' => in_array($answer_number, $request->right_answers)
                ]);
            }
            $answer->question_id = $question->id;
            $answer->save();
        }
        return redirect()->route('questions.all', $question->quiz_id);
    }

    public function delete(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.all', $question->quiz_id);
    }

}


