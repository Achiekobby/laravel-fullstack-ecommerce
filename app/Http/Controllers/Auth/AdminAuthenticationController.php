<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthenticationController extends Controller
{
    public function login(){
        return view("auth.admin.login");
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required|string|max:255|min:8"
        ]);

        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();

            Session::flash('success','successfully logged in into admin account');

            return redirect()->intended('/admin/dashboard');
        }
        return redirect()->route('admin.login')->with('error','Wrong credentials');
    }

    public function logout(){
        Auth::guard('admin')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success','You have successfully logged out of the admin portal');
    }
}
