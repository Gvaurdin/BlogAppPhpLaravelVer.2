@extends('layouts.app')

@section('title', 'Admin | Edit post')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование поста</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.posts.store') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $post->id }}">

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Пользователь</label>

                                <div class="col-md-6">
                                    <p>Текущий автор ID: {{ $post->user_id }}</p>
                                    <select  class="form-select" name="user_id" id="user_id">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $post->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Заголовок поста</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title', $post->title) }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="text" class="col-md-4 col-form-label text-md-end">Текст поста</label>

                                <div class="col-md-6">
                                <textarea class="form-control @error('text') is-invalid @enderror"
                                          name="text">{{ old('text', $post->text) }}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Обновить пост
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
