@extends('layouts.app')

@section('title', 'Admin | Edit user')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование пользователя</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">ФИО пользователя</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="text" class="col-md-4 col-form-label text-md-end">Email пользователя</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="Оставьте пустым, если не хотите менять">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Подтвердите пароль</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Подтвердите пароль">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="is_admin" class="col-md-4 col-form-label text-md-end">Администратор</label>

                                <div class="col-md-6">
                                    <input id="is_admin" type="checkbox" class="form-check-input @error('is_admin') is-invalid @enderror"
                                           name="is_admin" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                                    @error('is_admin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Обновить пользователя
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
