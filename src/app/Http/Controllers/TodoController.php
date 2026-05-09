<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Http\Requests\TodoRequest;
use App\Http\Controllers\CategoryController;

class TodoController extends Controller
{
    public function index(Request $request)
        {
        $categories = Category::all();

        $query = Todo::query()->with('category');

        $todos = $query->orderBy('created_at','desc')
                         ->paginate(10)
                         ->appends($request->except('page'));
        return view('index',compact('todos','categories',));
        }

    public function search(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->input('keyword');
        $categoryKeyword = $request->input('category_keyword');

        $query = Todo::query()->with('category');

        if($keyword) {
            $query->where('content', 'like', "%{$keyword}%");
        }

        if($categoryKeyword) {
            $query->whereHas('category', function($q)
            use($categoryKeyword){
                $q->where('name', 'like', "%{$categoryKeyword}%");
            });
        }

        $todos = $query->orderBy('created_at', 'desc')              ->paginate(10)
                            ->appends($request->all());

        return view('index', compact('todos','categories'));
    }


    public function store(TodoRequest $request)
    {
        $category = Category::firstOrCreate([
            'name' => $request->new_category,
        ]);
        Todo::create([
                    'content' => $request->content,
                    'category_id' => $category->id,
        ]);

        return redirect()->route('todos.index')->with('success','Todoを作成しました');
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        //更新//
        $todo->update(['content' => $request->content,
                       'category_id' => $request->category_id,
                       ]);
        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
    $todo->delete(); //削除//
    return redirect()->route('todos.index');
    }

}
