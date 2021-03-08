<?php

namespace App\Http\Controllers\Front\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;

class Dashboard extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('front.users.dashboard', compact('user'));
    }
    public function settingsUpdate(Request $request)
    {
        $rules = ['name' => 'required|min:3' , 'email' => 'required|email','password' => 'min:6','password2' => 'required_with:password|same:password|min:6'];
        $validate =  Validator::make($request->post(), $rules);
        if ($validate->fails()) {
            return redirect()->route('users.index')->withErrors($validate);
        }

        $user = User::where('id', auth()->user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        toastr()->success('Ayarlar başarılı bir şekilde güncellendi');
        return redirect()->route('users.index');
    }
}
