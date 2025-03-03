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
                <a href="{{ route('admin.users.edit', $user) }}">{{ $user->name }}</a><br>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Редактировать</a>

                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-danger btn-sm delete-button"
                            data-id="{{ $user->id }}"
                            data-entity="пользователя"
                            data-name="{{$user->name}}">Удалить</button>
                </div>
            </li>
        @endforeach
    </ul>
@endsection


