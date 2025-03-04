@extends('layouts.app')

@section('title', 'Main')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Blog</div>
                    @include('parts.messages')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Welcome to blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
