@extends('layouts.app')
@section('page-title') Артист @endsection

@section('content')
<div class="container-fluid" style="background: linear-gradient(#000, #6e6e6e);">
    @include('components.header')

    @include('components.artistPage.artistInfo')

    @include('components.artistPage.itemContainer',[
    "title"=>"АЛЬБОМЫ",
    "containerId"=>"albumNodes",
    "containerColor"=>"#f5f4f42f"
    ]);

    @include('components.artistPage.itemContainer',[
    "title"=>"ВИДЕО",
    "containerId"=>"videoNodes",
    "containerColor"=>"#1f1e1efd"
    ]);
    
    <div class="row" style="height:7vh;"></div>
    <div id="artistId" hidden>{{$id}}</div>
    <script src="/js/artist.js" type="module"></script>
</div>
@endsection