@extends('layouts.app')

@section('title', 'Admin | Create post' )

@section('menu')
    @include('admin.parts.menu')
@endsection

{{--@dump($errors)--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
{{--            @if($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach($errors->all() as $error)--}}
{{--                            <li>{{$error}}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
            <div class="card">
                <div class="card-header">Add post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Заголовок поста</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" autofocus value="{{old('title')}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Текст поста</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text">
                                    {{old('text')}}
                                </textarea>
                                @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--@section('content')--}}
{{--    <form action="{{ route('admin.addPost') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <div class="mb-3">--}}
{{--            <label for="title" class="form-label">Заголовок</label>--}}
{{--            <input type="text" class="form-control" id="title" name="title" required>--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label for="text" class="form-label">Текст</label>--}}
{{--            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">Добавить пост</button>--}}
{{--    </form>--}}
{{--@endsection--}}


