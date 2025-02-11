@extends('layouts.app')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <h1>Все посты</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">Добавить новый пост</a>

    @include('admin.parts.messages')

    <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item">
                <strong>{{ $post->title }}</strong>
                <p>{{ $post->text }}</p>
                <div>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <a href="{{ route('admin.posts.delete', $post->id) }}" class="btn btn-danger btn-sm">Удалить</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

