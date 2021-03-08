<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('created_at', 'DESC')->get();
        return view('back.categories.index', $data);
    }
    public function switch(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = $category->status ? 0 : 1 ;
        $category->save();
    }
    public function create(Request $request)
    {
        $isExist= Category::whereSlug(STR::slug($request->category))->first();
        if ($isExist) {
            toastr()->error($request->category . ' Adında bir kategori mevcut!!');
            return redirect()->route('admin.category.index');
        } else {
            $category = new Category;
            $category->name = $request->category;
            $category->slug = STR::slug($request->category);
            $category->save();
            toastr()->success('Kategori başarılı bir şekilde eklendi.');
            return redirect()->route('admin.category.index');
        }
    }
    public function update(Request $request)
    {
        $isExist= Category::whereSlug(STR::slug($request->category))->first();
        if ($isExist) {
            toastr()->error($request->category . ' Adında bir kategori mevcut!!');
            return redirect()->route('admin.category.index');
        } else {
            $category = Category::find($request->id);
            $category->name = $request->category;
            $category->slug = STR::slug($request->category);
            $category->save();
            toastr()->success('Kategori başarılı bir şekilde güncellendi.');
            return redirect()->route('admin.category.index');
        }
    }
    public function getData(Request $request)
    {
        $category = Category::find($request->id);
        return response()->json($category);
    }
    public function delete(Request $request)
    {
        $message ="";
        $category=Category::findOrFail($request->id);
        $categoryFirst = Category::findOrFail(1);
        $count = $category->articleCount();
        if ($category->articleCount()>0) {
            $article = Article::where('category_id', $category->id)->update(['category_id' => 1]);
            $message = 'Bu kategoriye ait '. $count . ' makale ' . $categoryFirst->name . ' kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success($message, 'Kategori başarılı bir şekilde silindi.');
        return redirect()->route('admin.category.index');
    }
}
