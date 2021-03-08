<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('back.pages.index', compact('pages'));
    }
    public function create()
    {
        return view('back.pages.create');
    }
    public function switch(Request $request)
    {
        $page = Page::find($request->id);
        $page->status = $page->status ? 0 : 1 ;
        $page->save();
    }
    public function post(Request $request)
    {
        $pageOrder = Page::orderBy('order', 'Desc')->first();
        $request->validate([
        'title' => 'min:3',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
      ]);


        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = STR::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = STR::slug($request->title). date('-Y-m-d-H-i-s').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/'.$imageName;
        }
        $page->order = $pageOrder->order + 1;
        $page->save();
        toastr()->success('Sayfa başarılı bir şekilde eklendi.');
        return redirect()->route('admin.page.index');
    }
    public function update($id)
    {
        $page = Page::find($id);
        return view('back.pages.update', compact('page'));
    }
    public function updatePost(Request $request, $id)
    {
        $request->validate([
        'title' => 'min:3',
        'image' => 'image|mimes:jpeg,png,jpg|max:2048'
      ]);


        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = STR::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = STR::slug($request->title). date('-Y-m-d-H-i-s').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Sayfa başarılı bir şekilde güncellendi.');
        return redirect()->route('admin.page.index');
    }
    public function delete($id)
    {
        Page::find($id)->delete();
        toastr()->success('Sayfa başarılı bir şekilde silindi.');
        return redirect()->route('admin.page.index');
    }
    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key]);
        }
    }
}
