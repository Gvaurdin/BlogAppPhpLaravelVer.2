@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h1>Все посты</h1>

    <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a>
            </li>
        @endforeach
    </ul>
@endsection
