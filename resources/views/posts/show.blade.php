@extends('layouts.app')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        @if($post->image)
                            <img style="width: 200px; height: auto;" class="me-3 float-start" src="{{ asset('storage/' . $post->image) }}" alt="post_image">
                        @endif
                        {{ $post->text }}
                    </div>
                    <button data-id="{{ $post->id }}" class="btn btn-primary w-25 likeButton ms-3 mb-2">
                        Likes: <span id="likeCount">{{ $post->likes }}</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
