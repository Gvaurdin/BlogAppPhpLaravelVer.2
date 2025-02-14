@extends('layouts.app')

@section('title', 'Admin | Delete user')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Удаление пользователя</div>

                    <div class="card-body text-center">
                        <p>Вы уверены, что хотите удалить пост <strong>{{ $user->name }}</strong>?</p>

                        <form method="POST" action="{{ route('admin.users.deleteUser') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <button type="submit" class="btn btn-danger">Удалить</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

