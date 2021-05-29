@extends('layouts.app')
@section('page-title') Восстановление @endsection

@section('content')
<div class="container">
    <div class="container-fluid mainbox">
        <div class="row">
            <div class="col-3 offset-9">
                <a href="{{route('start')}}"><img src="/images/minilogo.svg" width="160" height="80"></a>
            </div>
        </div>

        <div class="row" style="height: 15vh;">
            <div class="col-8 offset-2 text-center">
                <h2>Восстановление</h2>
            </div>
        </div>

        <div class="row h-50">
            <div class="col-4 offset-4 h-100 formbox">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row ">
                        <div class="col-10 offset-1 text-center">
                            <h6>Почта</h6>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 offset-1 text-center">
                            <h6>Пароль</h6>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 offset-1 text-center">
                            <h6>Повторите пароль</h6>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row h-25 align-items-center" style="margin-top: 25px;">
                        <div class="col">
                            <input type="submit" class="col-8 offset-2 mainbutton" value="Восстановить" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>>
@endsection