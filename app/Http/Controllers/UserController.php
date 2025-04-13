<?php
namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LogInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Services\RabbitmqService;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\exactly;

class UserController
{
    private RabbitmqService $rabbitmqService;
    public function __construct(RabbitmqService $rabbitmqService)
    {
        $this->rabbitmqService = $rabbitmqService;
    }

    public function getSignUpForm()
    {
        return view('signUpForm');
    }
    public function signUp(SignUpRequest $request)
    {
        $data = $request->validated();

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->rabbitmqService->produce(['user_id' => $user->id], 'sign-up-email');

        return response()->redirectTo('login');
    }
    public function getLoginForm()
    {
        return view('loginForm');
    }

    public function logIn(LogInRequest $request)
    {
        $result = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ] ;
        if (Auth::attempt($result)) {
            return response()->redirectTo('catalog');
        }
    }

    public function logOut()
    {
        Auth::logout();
        return view('loginForm');
    }

    public function getProfile()
    {
        $user = auth()->user();

        return view('userProfilePage', ['user' => $user]);
    }

    public function getEditForm()
    {
        $user = auth()->user();

        return view('editProfileForm', ['user' => $user]);
    }

    public function editProfile(EditProfileRequest $request)
    {
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


     }

}
