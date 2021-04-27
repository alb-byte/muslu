@extends('layouts.app')
@section('page-title') Поиск @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')
    @include('components.searchPage.itemListHeader')
    @include('components.searchPage.itemListContainer')
</div>
<script type="module">
    import ScrollCallBack from '/scripts/scroll.js';
    import Api from '/scripts/api.js';
    import {
        artistHtml,
        albumHtml,
        songHtml
    } from '/scripts/searchItems.js';

    let artistNodes = $("#artistList");
    let albumNodes = $("#albumList");
    let songNodes = $("#songList");

    function getArtistFromServer(name,startFrom){
        Api.get(Api.endpoints.artists, {
                name,
                startFrom
            }).then(response => {
                console.log(response);
                response.data.forEach(artist => {
                    artistNodes.append(artistHtml(artist.id, artist.name));
                });
            });
    }
    function getAlbumsFromServer(name,startFrom){
        Api.get(Api.endpoints.albums, {
                name,
                startFrom
            }).then(response => {
                console.log(response);
                response.data.forEach(album => {
                    albumNodes.append(albumHtml(album.id, album.name, album.artistName));
                });
            });
    }
    function getSongsFromServer(name,startFrom){
        Api.get(Api.endpoints.songs, {
                name,
                startFrom
            })
            .then(response => {
                console.log(response);
                response.data.forEach(song => {
                    songNodes.append(songHtml(song.id, song.name, song.audio, song.artistName, song.saved));
                });
            });
    }

    songNodes.scroll(ScrollCallBack((startFrom) => {
        if ($("#data").val()) getSongsFromServer($("#data").val(),startFrom);
    }));
    albumNodes.scroll(ScrollCallBack((startFrom) => {
        if ($("#data").val()) getAlbumsFromServer($("#data").val(),startFrom);
    }));
    artistNodes.scroll(ScrollCallBack((startFrom) => {
        if ($("#data").val()) getArtistFromServer($("#data").val(),startFrom);
    }));

    document.addEventListener("DOMContentLoaded",()=>{
        let name = $("#data").val();
        getArtistFromServer(name,null);
        getAlbumsFromServer(name,null);
        getSongsFromServer(name,null);
    });
</script>
@endsection