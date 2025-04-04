<?php
namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LogInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        return response()->redirectTo('catalog');
    }

    public function logOut()
    {
        Auth::logout();
        return view('loginForm');
    }

    public function getProfile()
    {
        if(Auth::check()) {

            $user = auth()->user();

            return view('userProfilePage', ['user' => $user]);
        } else {
            redirect()->route('login');
        }
    }

    public function getEditForm()
    {
        if(Auth::check()) {

            $user = auth()->user();

            return view('editProfileForm', ['user' => $user]);
        } else {
            redirect()->route('login');
        }
    }

    public function editProfile(EditProfileRequest $request)
    {

        if(Auth::check()) {

            $userId = auth()->id();

            $user = Auth::user();
            if (!(empty($request->name))) // не пустой => true
            {
                $user->name = $request->get('name');
            }

            if (!(empty($request->email))) {
                $user->email = $request->get('email');

            }

            if (!(empty($request->password))) {
                $user->password = $request->get('password');
            }

            $user->save();
        } else {
//            redirect()->route('login');
            view('welcome');
        }

     }

}
