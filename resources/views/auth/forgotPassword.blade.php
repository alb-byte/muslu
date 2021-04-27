@extends('layouts.startLayout')

@section('page-title') Восстановление @endsection

@section('content')
<div class="container-fluid mainbox">
    <div class="row">
        <div class="col-3 offset-9">
            <a href="{{route('start')}}"><img src="/images/minilogo.svg" width="160" height="80"></a>
        </div>
    </div>

    <div class="row" style="height: 12vh;">
        <div class="col-6 offset-3 text-center">
            <h2>Восстановление пароля</h2>
            <h6 class="text-danger text-center"></h6>
        </div>
    </div>

    <div class="row h-50">
        <div class="col-4 offset-4 h-100 formbox">
            <form method="post" class=" h-100" action="forgotPassword.php">
                <div class="row ">
                    <div class="col-10 offset-1 text-center">
                        <h6>Логин</h6>
                        <input type="text" class="form-control" name="login" />
                        @error('login')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 text-center">
                        <h6>Почта</h6>
                        <input type="text" class="form-control" name="email" />
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row h-25 align-items-center">
                    <div class="col">
                        <input type="submit" class="col-8 offset-2 mainbutton" value="Восстановить" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection