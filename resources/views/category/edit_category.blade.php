@extends('layout/layout')

@section('title')
    <title>Edit Category</title>
@endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('categories.update', $category->id)}}"
          style="width: 40%; margin: 3% auto;">
        @csrf
        @method('PUT')
        <h3>Edit Category</h3>
        <div class="box-body">
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input id="categoryName" type="text" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter category name" value="{{old('name', $category->name)}}" name="name">
                @error('name')
                <p class="text-danger mt-2">{{$errors->first('name')}}..</p>
                @enderror
            </div>
            <input type="hidden" name="_token" id='csrf_toKen' value="{{ csrf_toKen() }}">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection


