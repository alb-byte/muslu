@extends('layouts.app')

@section('content')
<div class="container-fluid mainbox">
    <div class="row">
        <div class="col-3 offset-9">
            <a href="{{route('start')}}"><img src="/images/minilogo.svg" width="160" height="80"></a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row h-75 justify-content-center align-items-center">
            <div class="col-8 offset-2 h-100 formbox">
                <h5>Подтвердите регистрацию в письме</h5>

                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    Письмо отправлено вам на почту
                </div>
                @endif

                <a href="{{ route('verification.resend') }}">Нажмите сюда чтобы отправить письмо еще раз</a>.
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@endsection