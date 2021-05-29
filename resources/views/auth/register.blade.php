@extends('layouts.app')

@section('page-title') Регистрация @endsection

@section('content')
<div class="container-fluid mainbox">
    <div class="row">
        <div class="col-3 offset-9">
            <a href="{{route('start')}}"><img src="/images/minilogo.svg" width="160" height="80"></a>
        </div>
    </div>

    <div class="row" style="height: 10vh;">
        <div class="col-6 offset-3 text-center h-100">
            <h2>Регистрация</h2>
            @error('auth')
            <h6 class="text-danger text-center">{{$message}}</h6>
            @enderror
        </div>
    </div>

    <div class="row h-75">
        <div class="col-4 offset-4 h-100 formbox">
            <form method="post" class=" h-100" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <h6>Имя</h6>
                        <input type="text" id="name" class="form-control" name="name" />
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <h6>Почта</h6>
                        <input type="email" id="email" class="form-control" name="email" />
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <h6>Пароль</h6>
                        <input type="password" id="password" class="form-control" name="password" />
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <h6>Повторите пароль</h6>
                        <input type="password" id="password-confirm" autocomplete="new-password"
                        class="form-control" name="password_confirmation" />
                        @error('password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <span style="color: white;">Уже зарегестрированы? </span>
                        <a href="{{route('login')}}" style="color:#FEFF77;">Войти</a>
                    </div>
                </div>
                <div class="row align-items-center h-25">
                    <div class="col">
                        <input type="submit" class="col-10 offset-1 mainbutton" value="Зарегестрироваться" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection