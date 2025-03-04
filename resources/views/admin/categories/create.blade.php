@extends('layouts.app')

@section('title', 'Admin | Create category' )

@section('menu')
    @include('admin.parts.menu')
@endsection
@dump($errors)
{{--@dump($errors)--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('parts.messages')
                <div class="card">
                    <div class="card-header">Add category</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Название категории</label>

                                <div class="col-md-6">
                                <textarea class="form-control @error('name') is-invalid @enderror" name="name">
                                    {{old('name')}}
                                </textarea>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add category
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
