@extends('layout.layout')

@section('title')
    <title>Edit Question</title>
@endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('questions.update', $question->id,
            count($question->answers))}}" style="width: 40%; margin: 3% auto;">
        @csrf
        @method('PUT')
        <h3>Edit Question</h3>
        <div class="box-body">

            <div class="form-group">
                <label for="questionBody">Edit Question Body</label>
                <textarea id="questionBody" class="form-control @error('body') is-invalid @enderror"
                          placeholder="Enter question body" name="body">{{old('body', $question->body)}}</textarea>
                @error('body')
                <p class="text-danger mt-2">{{$errors->first('body')}}..</p>
                @enderror
            </div>

            <h5>Change Question Type</h5>
            <fieldset class="form-group d-flex justify-content-between w-50 choose-question-type">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input single-choice"
                               name="is_multiple_choice" id="typeRadios1" value="0"
                               @if($question->is_multiple_choice == 0) checked="" @endif>
                        Single Choice
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input multiple-choice"
                               name="is_multiple_choice" id="typeRadios2" value="1"
                               @if($question->is_multiple_choice == 1) checked="" @endif>
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
                @foreach($question->answers as $key => $answer)
                    <div class="form-group">
                        <label for="answer_{{$key + 1}}">Answer {{$key + 1}}</label>
                        <input id="answer_{{$key + 1}}" type="text" class="form-control"
                               placeholder="Enter answer {{++$key}}"
                               value="{{$answer->answer_body}}" name="answers[]">
                    </div>
                @endforeach
            </div>
        </div>

        <h5>Set correct answer</h5>
        @error('right_answers')<p class="text-danger">You must select at least one correct answer
            when creating multiple choice question...</p>@enderror
        <fieldset class="form-group set-correct-ans d-flex flex-wrap w-75">
            @if($question->is_multiple_choice == 0)
                @foreach($question->answers as $key => $answer)
                    <div class="form-check mr-3">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="right_answer"
                                   id="answerRadios{{$key + 1}}"
                                   value="{{$key + 1}}" @if($answer->is_right == 1) checked="" @endif >
                            Answer {{$key + 1}}
                        </label>
                    </div>
                @endforeach
            @else
                @foreach($question->answers as $key => $answer)
                    <div class="form-check mr-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="right_answers[]"
                                   value="{{$key + 1}}" @if($answer->is_right == 1) checked="" @endif >
                            Answer {{$key + 1}}
                        </label>
                    </div>
                @endforeach
            @endif
        </fieldset>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <script src="{{asset("js/create_question.js")}}"></script>
@endsection


