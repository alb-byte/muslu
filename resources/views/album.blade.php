@extends('layouts.app')
@section('page-title') Альбом @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')
    @include('components.albumPage.songHeader')

    <div class="row align-items-center" style="height: 70vh;">
        <div id="songsContainer" 
        class="h-100 col-6 offset-1 text-center" 
        style="background-color:#2c2c2c;overflow-y:scroll;">
        </div>
        @include('components.albumPage.albumInfo')
    </div>
    <div id="parm" hidden>{{$album}}</div>
</div>
@endsection