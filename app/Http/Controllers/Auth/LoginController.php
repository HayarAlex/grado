<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }
    public function login(){
        $user = $this->validate(request(),[
            'email' => 'required|email|string',
            'password' => 'required|string'
         ]);

        if(Auth::attempt($user))
        {
            return redirect()->route('home');
        }else{
            return back()
            ->withErrors(['email'=>trans('auth.failed')])
            ->withInput(request(['email']));
        }
        

    }
    public function logOut(){
        Auth::logout();
        return redirect('/');
    }
}
