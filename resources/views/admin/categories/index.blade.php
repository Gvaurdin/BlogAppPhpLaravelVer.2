@extends('layouts.app')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <h1>Все категории</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Добавить новую категорию</a>

    @include('admin.parts.messages')

    <ul class="list-group">
        @foreach($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a><br>
                <div>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <a href="{{ route('admin.categories.delete', $category) }}" class="btn btn-danger btn-sm">Удалить</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection


