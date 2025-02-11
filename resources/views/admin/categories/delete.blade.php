@extends('layouts.app')

@section('title', 'Admin | Delete category')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Удаление категории</div>

                    <div class="card-body text-center">
                        <p>Вы уверены, что хотите удалить категорию <strong>{{ $category->name }}</strong>?</p>

                        <form method="POST" action="{{ route('admin.categories.store') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $category->id }}">

                            <button type="submit" class="btn btn-danger">Удалить</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
