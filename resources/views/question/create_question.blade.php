@extends('layout.layout')

@section('title')
    <title>Add Question</title>
@endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('questions.save', $quiz->id)}}"
          style="width: 40%; margin: 3% auto;">

        <h3>Create Question</h3>
        <div class="box-body">

            <div class="form-group">
                <label for="questionBody">Question Body</label>
                <textarea id="questionBody" class="form-control @error('body') is-invalid @enderror"
                          placeholder="Enter question body" name="body">{{old('body')}}</textarea>
                @error('body')
                <p class="text-danger mt-2">{{$errors->first('body')}}..</p>
                @enderror
            </div>

            <h5>Select Question Type</h5>
            <fieldset class="form-group d-flex justify-content-between w-50 choose-question-type">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input single-choice"
                               name="is_multiple_choice" id="typeRadios1" value="0" checked="">
                        Single Choice
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input multiple-choice"
                               name="is_multiple_choice" id="typeRadios2" value="1">
                        Multiple Choice
                    </label>
                </div>
            </fieldset>

            <button type="button" class="btn btn-success add-answer mb-3">
                Add Answer
            </button>
            <button type="button" class="btn btn-danger remove-answer mb-3">
                Remove Last Answer
            </button>

            @error('answers.*')<p class="text-danger">You must fill all answer fields...</p>@enderror
            <div class="answer-set">
                <div class="form-group">
                    <label for="answer_1">Answer 1</label>
                    <input id="answer_1" type="text" class="form-control"
                           placeholder="Enter answer 1" name="answers[]">
                </div>
                <div class="form-group">
                    <label for="answer_2">Answer 2</label>
                    <input id="answer_2" type="text" class="form-control"
                           placeholder="Enter answer 2" name="answers[]">
                </div>
            </div>
        </div>

        <h5>Set correct answer</h5>
        @error('right_answers')<p class="text-danger">You must select at least one correct answer
            when creating multiple choice question...</p>@enderror
        <fieldset class="form-group set-correct-ans d-flex flex-wrap w-75">
            <div class="form-check mr-3">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="right_answer"
                           id="answerRadios1" value="1" checked="">
                    Answer 1
                </label>
            </div>
            <div class="form-check mr-3">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="right_answer"
                           id="answerRadios2" value="2">
                    Answer 2
                </label>
            </div>
        </fieldset>

        <input type="hidden" name="_token" id='csrf_toKen' value="{{ csrf_toKen() }}">
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
    <script src="{{asset("js/create_question.js")}}"></script>
@endsection


