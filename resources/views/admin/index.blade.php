@extends('layouts.app')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <h2>Main page admin</h2>
    @include('admin.parts.messages')
@endsection

