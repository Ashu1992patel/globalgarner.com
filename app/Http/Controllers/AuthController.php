<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('components.user.login');
    }

    public function register()
    {
        return view('components.user.register');
    }

    public function process_login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (auth()->attempt($credentials)) {
            return redirect()->back()->with('success', "Hey $user->name, Welcome back to Global Garner!!");
        } else {
            return redirect()->back()->with('error', 'Oops!! Invalid credentials, Please try agai later!!');
        }
    }

    public function process_signup(RegisterRequest $request)
    {
        $user = User::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        auth()->attempt([
            'email' => $user->email,
            'password' => $request->input('password'),
        ]);

        return redirect()->back()->with('success', "Hey $user->name, Welcome to Global Garner, Your account has been created successfully!!!!");
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->back()->with('success', 'You have been logged out successfully!!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Oops!! Somethig went wrong, please try again later!!');
        }
    }
}
