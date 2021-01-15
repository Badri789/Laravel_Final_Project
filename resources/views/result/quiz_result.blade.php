@extends('layout.layout')

@section('title')
    <title>Quiz Result</title>
@endsection

@section('content')
    <div style="max-width: 20rem; margin: 5% auto 0"
         class="card text-white mb-3 @if($is_passed) bg-success @else bg-danger @endif" >
        <div class="card-header">@if($is_passed)You Passed ! @else You Failed ! @endif</div>
        <div class="card-body">
            <h5 class="card-title">Min Limit: {{$min_limit}}%</h5>
            <h5 class="card-title">Your Result: {{$user_percentage}}%</h5>
            <h5 class="card-text">Your Score: {{$user_score}} / {{$max_score}}</h5>
        </div>
    </div>
@endsection
