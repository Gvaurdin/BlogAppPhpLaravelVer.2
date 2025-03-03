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
                @if($post->image)
                    <img style="width: 200px; height: auto;" class="me-3 float-start" src="{{ asset('storage/' . $post->image) }}" alt="post_image">
                @endif
                <p>{{ $post->text }}</p>

                <div>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Редактировать</a>

                    <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.delete', $post->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-button"
                                data-id="{{ $post->id }}"
                                data-entity="пост"
                                data-name="{{$post->title}}">Удалить</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection



