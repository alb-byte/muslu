@extends('layouts.app')

@section('page-title') Вход @endsection

@section('content')
<div class="container-fluid mainbox">
    <div class="row">
        <div class="col-3 offset-9">
            <a href="{{route('start')}}"><img src="/images/minilogo.svg" width="160" height="80"></a>
        </div>
    </div>

    <div class="row" style="height: 15vh;">
        <div class="col-2 offset-5 text-center">
            <h2>Вход</h2>
            @error('auth')
            <h6 class="text-danger text-center">{{$message}}</h6>
            @enderror
        </div>
    </div>

    <div class="row h-50">
        <div class="col-4 offset-4 h-100 formbox">
            <form method="post" class=" h-100" action="{{ route('login') }}">
                @csrf
                <div class="row ">
                    <div class="col-10 offset-1 text-center">
                        <h6>Почта</h6>
                        <input type="email" id="email" name="email" class="form-control" />
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
                <div class="row justufy-content-center">
                    <div class="col-10 offset-1 text-center">
                        <h6>Запомнить меня</h6>
                        <input class=" col" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <span style="color: white;">Не зарегестрированы? </span>
                        <a href="{{route('register')}}" style="color:#FEFF77;">Зарегистрироваться</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <span style="color: white;">Забыли пароль? </span>
                        <a href="{{ route('password.request') }}" style="color:#FEFF77;">Восстановить</a>
                    </div>
                </div>
                <div class="row h-25 align-items-center">
                    <div class="col">
                        <input type="submit" class="col-8 offset-2 mainbutton" value="Войти" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection