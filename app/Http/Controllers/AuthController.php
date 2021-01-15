<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('user/login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->except('_token');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('quizzes.all');
            } else {
                return redirect()->route('user-quizzes.all');
            }
        } else {
            return redirect()->back()->with('alert', 'Login credentials are incorrect!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('user/register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->save();
        Auth::login($user);
        return redirect()->route('user-quizzes.all');
    }
}
