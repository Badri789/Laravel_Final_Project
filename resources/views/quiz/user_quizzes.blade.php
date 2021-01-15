@extends('layout.layout')

@section('title')
    <title>My Quizzes</title>
@endsection

@section('content')
    @if (session('alert'))
        <div class="alert alert-dismissible alert-danger mt-2" style="width: 35%; margin: 0 auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>{{session('alert')}}</p>
        </div>
    @endif
    @foreach($quizzes as $quiz)
        <div class="card border-secondary mt-4" style="width: 50%; margin: 0 auto;">
            <div class="card-header">
                <h5 class="card-title">{{$quiz->title}}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">{{$quiz->description}}</p>
                <p class="card-text">
                    <img src="{{asset('icons/timer.svg')}}" alt="" width="22em">
                    Duration: {{$quiz->duration}} minutes
                </p>
                @if(count($quiz->categories) > 0)
                    <div class="mb-3">
                        <img src="{{asset('icons/categories.svg')}}" alt="" width="22em">
                        Categories:
                        @foreach($quiz->categories->pluck('name') as $category)
                            <p style="display: inline">@if($loop->last){{$category}} @else {{$category}},@endif</p>
                        @endforeach
                    </div>
                @endif
                <form method="get" action="{{route('quiz.submission', $quiz->id)}}" style="display: inline">
                    <label for="startQuiz">Start this quiz</label>
                    <input id="startQuiz" type="text" class="form-control" placeholder="Enter quiz access code"
                           name="access_code">
                    <input class="btn btn-primary mt-2" type="submit" value="Start">
                </form>
            </div>
        </div>
    @endforeach
@endsection
