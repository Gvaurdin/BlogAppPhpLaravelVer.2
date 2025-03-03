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

                    <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-button"
                                data-id="{{ $category->id }}"
                                data-entity="категорию"
                                data-name="{{$category->name}}">Удалить</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection





