@extends('layouts.app')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @forelse ($posts as $post)

                    <a href="{{ route('posts.show',$post->id) }}">{{ $post->title }} : {{$post->likes}}</a><br>
                @empty
                    <p>Нет постов</p>
                @endforelse

            </div>
            {{$posts->links()}}
        </div>
    </div>
@endsection
