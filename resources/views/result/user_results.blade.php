@extends('layout.layout')

@section('title')
    <title>Results</title>
@endsection

@section('content')
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Quiz</th>
            <th scope="col">User Score</th>
            <th scope="col">Max Score</th>
            <th scope="col">User Percentage</th>
            <th scope="col">Is Passed</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $key => $result)
            @can('view-results', $result)
            <tr>
                <th scope="row">{{$key + 1}}</th>
                <td>{{$result->user->name}}</td>
                <td>{{$result->quiz->title}}</td>
                <td>{{$result->user_score}}</td>
                <td>{{$result->max_score}}</td>
                <td>{{$result->user_percentage}}</td>
                @if($result->is_passed == 0)
                    <td class="table-danger">No</td>
                @else
                    <td class="table-success">Yes</td>
                @endif
                <td>{{$result->created_at}}</td>
            </tr>
            @endcan
        @endforeach
        </tbody>
    </table>
@endsection
