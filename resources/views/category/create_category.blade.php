@extends('layout/layout')

@section('title')
    <title>Create Category</title>
@endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('categories.save')}}"
          style="width: 40%; margin: 3% auto;">
        <h3>Create Category</h3>
        <div class="box-body">
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input id="categoryName" type="text" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter category name" name="name" value="{{old('name')}}">
                @error('name')
                <p class="text-danger mt-2">{{$errors->first('name')}}..</p>
                @enderror
            </div>
            <input type="hidden" name="_token" id='csrf_toKen' value="{{ csrf_toKen() }}">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection
