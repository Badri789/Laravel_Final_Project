@extends('layout.layout')

@section('title')
    <title>Edit Quiz</title>
@endsection

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('quizzes.update', $quiz->id)}}"
          style="width: 40%; margin: 3% auto;">
        @csrf
        @method('PUT')
        <h3>Edit Quiz</h3>
        <div class="box-body">
            <div class="form-group">
                <label for="quizTitle">Quiz Title</label>
                <input id="quizTitle" type="text" class="form-control @error('title') is-invalid @enderror"
                       placeholder="Enter quiz title" value="{{old('title', $quiz->title)}}" name="title">
                @error('title')
                <p class="text-danger mt-2">{{$errors->first('title')}}..</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="quizDescription">Quiz Description</label>
                <textarea id="quizDescription" class="form-control @error('title') is-invalid @enderror"
                          placeholder="Enter quiz description"
                          name="description">{{old('description', $quiz->description)}}</textarea>
                @error('description')
                <p class="text-danger mt-2">{{$errors->first('description')}}..</p>
                @enderror
            </div>
            <div>
                <label for="accessCode">Access Code</label>
                <div class="form-group d-flex justify-content-between">
                    <input id="accessCode" type="text" class="form-control random-access-code w-75
                    @error('access_code') is-invalid @enderror" placeholder="Generate random access code"
                           name="access_code" value="{{old('access_code', $quiz->access_code)}}" readonly>
                    <button type="button" class="btn btn-primary generate-access-code">Generate</button>
                    @error('access_code')
                    <p class="text-danger mt-2">{{$errors->first('access_code')}}..</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="quizDuration">Quiz Duration</label>
                <input id="quizDuration" type="number" class="form-control @error('duration') is-invalid @enderror"
                       placeholder="Enter quiz duration in minutes" value="{{old('duration', $quiz->duration)}}"
                       name="duration">
                @error('duration')
                <p class="text-danger mt-2">{{$errors->first('duration')}}..</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="categorySelect" style="display: block">Categories</label>
                <select name="categories[]" id="categorySelect" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if(in_array($category->id, $quiz->categories->pluck('id')->toArray()))
                                selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <script src="{{asset("/js/create_quiz.js")}}"></script>
@endsection
