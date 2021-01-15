@extends('layout.layout')

@section('title')
    <title>Take a Quiz</title>
@endsection

@section('content')
    <div style="margin: 0 auto; width: 50%">
        <h3 class="text-center m-4">{{$quiz->title}}</h3>
        <div class="d-flex justify-content-center">
            <img class="mt-1" src="{{asset('icons/timer.svg')}}" alt="" height="30em" width="30em">
            <h3 class="timer mt-1"></h3>
        </div>
    </div>

    <form enctype="multipart/form-data" action="{{route('quiz.submit', $quiz->id)}}">
        @foreach($questions as $question)
            <div style="width: 50%; margin: 0 auto;" class="card mt-4">
                <div class="card-body">
                    <p class="card-text">{{$question->body}}</p>
                    <hr class="my-4">
                    <p>Options:</p>
                    <fieldset class="form-group">
                        @if($question->is_multiple_choice == 0)
                            @foreach($question->answers as $key => $answer)
                                <div class="form-check mr-3">
                                    <p>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"
                                                   name="question_{{$question->id}}" id="answerRadios{{$key + 1}}"
                                                   value="{{$key + 1}}">
                                            {{$answer->answer_body}}
                                        </label>
                                    </p>
                                </div>
                            @endforeach
                        @else
                            @foreach($question->answers as $key => $answer)
                                <div class="form-check mr-3">
                                    <p>
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input"
                                                   name="question_{{$question->id}}[]" value="{{$key + 1}}">
                                            {{$answer->answer_body}}
                                        </label>
                                    </p>
                                </div>
                            @endforeach
                        @endif
                    </fieldset>
                </div>
            </div>
        @endforeach
        <input type="hidden" name="_token" id='csrf_toKen' value="{{ csrf_toKen() }}">
        <div class="box-footer w-25 text-center mt-3 mb-3" style="margin: 0 auto">
            <button type="submit" class="btn btn-primary submit-quiz-btn">Submit</button>
        </div>
    </form>
    <p hidden class="quiz-duration">{{$quiz->duration}}</p>
    <script src="{{asset("/js/submit_quiz.js")}}"></script>
@endsection
