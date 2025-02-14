@extends('layouts.app')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <h1>Все пользователи</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Добавить нового пользователя</a>

    @include('admin.parts.messages')

    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <strong>{{ $user->name }}</strong>
                <p>{{ $user->email }}</p>

                <div>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <a href="{{ route('admin.users.delete', $user->id) }}" class="btn btn-danger btn-sm">Удалить</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

