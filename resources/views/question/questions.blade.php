@extends('layout.layout')

@section('title')
    <title>Quiz Questions</title>
@endsection

@section('content')
    @foreach($questions as $question)
        <div style="width: 50%; margin: 0 auto;" class="card mt-4">
            <div class="card-body">
                <p class="card-text">{{$question->body}}</p>
                <hr class="my-4">
                <p>Answers:</p>
                @foreach($question->answers as $key => $answer)
                    <p class="@if($answer->is_right == 1)
                        form-control is-valid text-success font-weight-bold @endif">
                        {{++$key}}) - {{$answer->answer_body}}
                    </p>
                @endforeach
            </div>
            <div class="w-50 m-1">
                <a class="btn btn-warning" href="{{route('questions.edit', $question->id)}}">
                    <img src="{{asset("icons/edit.svg")}}" alt=""
                         width="18em">
                    Edit
                </a>
                <form method="post" action="{{route('questions.delete', $question->id)}}" style="display: inline;
                position: relative">
                    @method('DELETE')
                    @csrf
                    <img src="{{asset("icons/trash.svg")}}" alt=""
                         width="18em" style="position: absolute; left: 15%; top: 10%">
                    <input class="btn btn-danger" type="submit" value="Delete" style="padding-left: 2.5em">
                </form>
            </div>
        </div>
    @endforeach
    <a href="{{route('questions.create', $quiz->id)}}" class="btn btn-primary float-right d-flex align-items-center
    justify-content-center" style="border-radius: 100%; width: 60px; height: 60px; margin: 1%; font-size: 1.5em">
        +
    </a>

@endsection
