<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = Config::find(1);
        return view('back.config.index', compact('configs'));
    }
    public function update(Request $request)
    {
        $config = Config::find(1);
        $config->title = $request->title;
        $config->status = $request->status;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedin = $request->linkedin;
        $config->youtube = $request->youtube;
        $config->github = $request->github;
        $config->instagram = $request->instagram;
        if ($request->hasFile('logo')) {
            $imageName = 'logo-'.STR::slug($request->title). date('-Y-m-d-H-i-s').'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $imageName);
            $config->logo = 'uploads/'.$imageName;
        }
        if ($request->hasFile('favicon')) {
            $imageName = 'favicon-'.STR::slug($request->title). date('-Y-m-d-H-i-s').'.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $imageName);
            $config->favicon = 'uploads/'.$imageName;
        }
        $config->save();
        toastr()->success('Ayarlar başarılı bir şekilde güncellendi.');
        return redirect()->route('admin.config.index');
    }
}
