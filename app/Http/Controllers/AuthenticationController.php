<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register() {
        return view('auth.register');
    }
    public function store(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email|email',
            'password'=>'min:8|required|confirmed',
            'password_confirmation'=>'min:8|required'
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if(Auth::attempt($request->only(['email','password']))) {
            return view('dashboard');
        }
    }
    public function create() {
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'min:8|required'
        ]);
        if(Auth::attempt($request->only(['email','password']))) {
            return view('dashboard');
        }
    }
}
