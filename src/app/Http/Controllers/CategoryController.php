<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category',compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success','カテゴリを作成しました');
    }

    public function update(Request $request,Category $category)
    {
        return redirect()->route('categories.index')->with('success','カテゴリを更新しました');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
