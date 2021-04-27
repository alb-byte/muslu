@extends('layouts.app')

@section('content')
<div class="container-fluid mainbox">
    <div class="row">
        <div class="col-3 offset-9">
            <a href="index.php"><img src="./static/images/minilogo.svg" width="160" height="80"></a>
        </div>
    </div>

    <div class="row" style="height: 12vh;">
        <div class="col-6 offset-3 text-center">
            <h2>Восстановление пароля</h2>
        </div>
    </div>

    <div class="row h-50">
        <div class="col-4 offset-4 h-100 formbox">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row h-50">
                    <div class="col-10 offset-1 text-center">
                        <h6>Почта</h6>
                        <input type="email" id="email" class="form-control" name="email" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row h-25 align-items-center">
                    <div class="col">
                        <input type="submit" class="col-8 offset-2 mainbutton" value="Получить ссылку" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection