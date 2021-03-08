<?php

namespace App\Http\Controllers\Front\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function loginPost(Request $request)
    {
        $rules = ['email' => 'required|email','password' => 'required'];
        $validate =  Validator::make($request->post(), $rules);
        if ($validate->fails()) {
            return redirect()->route('homepage')->withErrors($validate)->withInput();
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            toastr()->success('Hoşgeldiniz '.Auth::user()->name);
            return redirect()->route('homepage');
        }
        return redirect()->route('homepage')->withErrors('E-Mail veya Şifre yanlış');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
