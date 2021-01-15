@extends('layout/layout')

@section('title')
    <title>Register</title>
@endsection

@section('content')
    <form method="post" action="{{route('post.register')}}" style="width: 40%; margin: 3% auto">
        @csrf
        <h3>Register</h3>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="username" name="name" placeholder="Enter username">
            @error('name')
            <p class="text-danger mt-2">{{$errors->first('name')}}..</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" placeholder="Enter email">
            @error('email')
            <p class="text-danger mt-2">{{$errors->first('email')}}..</p>
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
        <div class="form-group">
            <label for="password-confirmation">Password Confirmation</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password-confirmation" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <p class="text-danger mt-2">{{$errors->first('password_confirmation')}}..</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">
            <img src="{{asset('icons/register.svg')}}" alt=""
                 width="18em">
            Register
        </button>
    </form>
@endsection

