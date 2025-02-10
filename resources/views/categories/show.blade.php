@extends('layouts.app')

@section('title', 'Категория')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $category->name }}</div>

                    <div class="col-md-12">

                        @forelse ($posts as $post)

                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                        @empty
                            <p>Нет постов у этой категории</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
