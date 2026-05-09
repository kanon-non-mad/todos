@extends('layouts.app')

@section('title', 'category.blade.php')

@section('content')

    <div class="category-form__content">
        <form class="form" method="POST" action="{{route('categories.store')}}">
                @csrf
            <input type="text" class="form-text" name="name">
            
            <button class="form__button-submit" type="submit">作成</button>
        </form>

    <div class="category-title">category</div>

    @foreach($categories as $category)
    <div class="category__content">
        <form class="category__form" action="{{route('categories.update',$category)}}"  method="POST" >
                @csrf
                @method('PATCH')
            <input type="text" class="category__content-text" name="name" value="{{$category->name}}">
            <input type="hidden" class="category__content-text" name="id" value="{{$category->id}}">
            <div class="category__content-button">
            <button class="category__content-update">
            更新</button>
            </div>
        </form>
        <form class="category__form-delete" action="{{route('categories.destroy',$category->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="name" value="{{$category->name}}">
            <div class="category__content-button">
            <button type="submit" class="category__content-delete">削除</button>
            </div>
        </form>
        </div>
        @endforeach
    </div>


@endsection