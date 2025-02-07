@extends('layouts.app')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <form action="{{ route('admin.addPost') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Текст</label>
            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Добавить пост</button>
    </form>
@endsection


