<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Inbox;
use Validator;
use App\Models\Config;

class HomePage extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->status == 0) {
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages', Page::where('status', 1)->orderBy('order', 'ASC')->get());
        view()->share('categories', Category::where('status', 1)->orderBy('id', 'ASC')->get());
    }
    public function index()
    {
        $data['articles'] = Article::with('getCategory')->where('status', 1)->whereHas('getCategory', function ($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'DESC')->paginate(10);
        return view('front.homepage', $data);
    }
    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
        $data['article'] = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
        $data['article']->increment('hit');
        return view('front.single', $data);
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
        return view('front.category', $data);
    }
    public function page($slug)
    {
        $data['page'] = Page::whereSlug($slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı');
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }
    public function contactpost(Request $request)
    {
        $rules=[
        'name' => 'required|min:5',
        'email' => 'required|email',
        'topic' => 'required',
        'message' => 'required|min:10',
      ];
        $validate =  Validator::make($request->post(), $rules);
        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        $contact = new Inbox;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi. Teşşekür ederiz');
    }
}
