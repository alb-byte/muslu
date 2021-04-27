@extends('layouts.app')

@section('page-title') muslu @endsection

@section('content')
<div class="container-fluid mainbox">
    <div class="row justify-content-center align-items-center h-75">
        <div class="col-6">
            <img src="/images/logo.svg">
        </div>
    </div>

    <div class="row align-items-center h-25">
        <div class="col-1 offset-8">
            <a class="mainbutton" href="{{route('login')}}">Вход</a>
        </div>
        <div class="col-1">
            <a class="mainbutton" href="{{route('register')}}">Регистрация</a>
        </div>
    </div>
</div>
@endsection