@extends('layouts.app')

@section('title', 'index.blade.php')

@section('content')

    <div class="todo-form__content">
        <form class="form" method="POST" action="{{route('todos.store')}}">
            @csrf
            <div class="form__category">
                <label for="content">新規作成</label>
                <div class="form__category-row">
                    <input type="text" class="form__category-text" name="content" id="content"
                    value="{{old('content')}}"required>
                    <input type ="text" class="new__category" name="new_category" placeholder="カテゴリ">
                    <button class="form__button-submit" type="submit">作成</button>
                </div>
            </div>
        </form>
        <form class="category__search" method="GET" action="{{route('todos.search')}}">
            <div class="category__search-form">
                <label for="keyword">Todo検索</label>
                <div class="category__search-row">
                    <input type="text" value="{{request('keyword')}}" class="category__search-todo" name="keyword" id="keyword">
                    <input type="text" class="category__search-keyword" name="category_keyword" value="{{request('category_keyword')}}" placeholder="カテゴリ">
                    <button type="submit" class="category__search--submit">検索</button>
                </div>
            </div>
        </form>

    <div class="todo-title">
        <div class="todo__title-list">Todo</div>
        <div class="todo__title-category">カテゴリ</div>
    </div>

    @foreach($todos as $todo)
    <div class="todo__content">
        <form class="todo__form" action="{{route('todos.update',$todo)}}"  method="POST" >
                @csrf
                @method('PATCH')
            <input type="text" class="todo__content-text" name="content" value="{{$todo->content}}">
            <select name="category_id" class="todo__category">
                @foreach($categories as $category)
                <option value="{{$category->id}}"
                {{$todo->category_id == $category->id ? 'selected' : ''}}>
                {{$category->name}}
                </option>
    @endforeach
            </select>
            <div class="todo__content-button">
            <button class="todo__content-update">
            更新</button>
            </div>
        </form>
        <form class="todo__form-delete" action="{{route('todos.destroy',$todo->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{$todo->id}}">
            <div class="todo__content-button">
            <button type="submit" class="todo__content-delete">削除</button>
            </div>
        </form>
        </div>
        @endforeach
    </div>


@endsection