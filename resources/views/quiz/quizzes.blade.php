@extends('layout.layout')

@section('title')
    <title>All Quizzes</title>
@endsection

@section('content')
    @foreach($quizzes as $quiz)
        <div class="card border-secondary mt-4" style="width: 50%; margin: 0 auto;">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">{{$quiz->title}}</h5>
                <div>
                    <a class="btn btn-warning" href="{{route('quizzes.edit', $quiz->id)}}">
                        <img src="{{asset('icons/edit.svg')}}" alt=""
                             width="18em">
                        Edit
                    </a>
                    <form method="post" action="{{route('quizzes.delete', $quiz->id)}}" style="display: inline;
                position: relative">
                        @method('DELETE')
                        @csrf
                        <img src="{{asset('icons/trash.svg')}}" alt=""
                             width="18em" style="position: absolute; left: 15%; top: 10%">
                        <input class="btn btn-danger" type="submit" value="Delete" style="padding-left: 2.5em">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$quiz->description}}</p>
                <p class="card-text font-weight-bold">Access Code: {{$quiz->access_code}}</p>
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
                <a class="btn btn-info" href="{{route('questions.all', $quiz->id)}}">
                    <img src="{{asset('icons/questions.svg')}}" alt=""
                         width="22em">
                    Manage Questions
                </a>
            </div>
        </div>
    @endforeach
@endsection
