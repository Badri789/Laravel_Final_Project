@extends('layout/layout')

@section('title')
    <title>Login</title>
@endsection

@section('content')

    <form method="post" action="{{route('post.login')}}" style="width: 40%; margin: 3% auto">
        @csrf
        @if (session('alert'))
            <div class="alert alert-dismissible alert-danger mt-2" style="width: 60%; margin: 0 auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>{{session('alert')}}</p>
            </div>
        @endif
        <h3>Login</h3>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="username" name="name" placeholder="Enter username">
            @error('name')
            <p class="text-danger mt-2">{{$errors->first('name')}}..</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" placeholder="Enter password">
            @error('password')
            <p class="text-danger mt-2">{{$errors->first('password')}}..</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">
            <img src="{{asset("icons/login.svg")}}" alt=""
                 width="18em">
            Login
        </button>
    </form>
@endsection


