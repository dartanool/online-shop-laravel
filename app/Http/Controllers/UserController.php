<?php
namespace App\Http\Controllers;

use App\Http\Requests\LogInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{

    public function getSignUpForm()
    {
        return view('signUpForm');
    }
    public function signUp(SignUpRequest $request)
    {
        $data = $request->all();

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->redirectTo('login');
    }
    public function getLoginForm()
    {
        return view('loginForm');
    }

    public function logIn(LogInRequest $request)
    {
        $result = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        response()->redirectTo('catalogPage');
    }
}
