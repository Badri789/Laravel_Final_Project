@extends('layout/layout')

@section('title')
    <title>Categories</title>
@endsection

@section('content')
    @foreach($categories as $category)
        <div style="width: 50%; margin: 0 auto;" class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">{{$category->name}}</h4>
            </div>
            <div class="w-50 m-1">
                <a class="btn btn-warning" href="{{route('categories.edit', $category->id)}}">Edit</a>
                <form method="post" action="{{route('categories.delete', $category->id)}}" style="display: inline">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    @endforeach
@endsection
