<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('index')->with('todos',$todos);
    }
}
