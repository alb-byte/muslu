@extends('layouts.app')
@section('page-title') Видео @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')

    <div class="row">
        <video id="myvideo" style="width:90vw; height:75vh;margin:auto;" poster="">
        </video>
    </div>
    <div id="controls" class="row">
        <i style="color:#FEFF77;" class="col-1 fas fa-play fa-2x offset-5"></i>
        <i id="videoId" style="color:#FEFF77;" class="col-1 fa-star fa-2x"></i>
    </div>
    <div id="parm" hidden>{{$video}}</div>
</div>
<script type="module">
    import {
        playVideo,
        likeVideo,
        ready
    } from '/js/videoPage.js';
    document.addEventListener("DOMContentLoaded", ready);
    $('i.fa-play').click((e) => playVideo(e));
    $('i.fa-star').click((e) => likeVideo(e.currentTarget.id, e));
</script>
@endsection