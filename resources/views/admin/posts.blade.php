@extends('layouts.app')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h1>Все посты</h1>
    <a href="{{ route('admin.addPostForm') }}" class="btn btn-success mb-3">Добавить новый пост</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item">
                <strong>{{ $post['title'] }}</strong>
                <p>{{ $post['text'] }}</p>
            </li>
        @endforeach
    </ul>
@endsection

