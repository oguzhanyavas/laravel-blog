<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    protected $username = 'email';
    public function login()
    {
        return view('back.auth.login');
    }
    public function loginPost(Request $request)
    {
        $rules = ['email' => 'required|email','password' => 'required'];
        $validate =  Validator::make($request->post(), $rules);
        if ($validate->fails()) {
            return redirect()->route('admin.login')->withErrors($validate)->withInput();
        }

        $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        if (Auth::attempt($credentials)) {
            toastr()->success('Hoşgeldiniz '.Auth::user()->name);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('E-Mail veya Şifre yanlış yada panele girmeye yetkiniz yok.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
