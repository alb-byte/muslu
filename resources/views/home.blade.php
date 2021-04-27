@extends('layouts.app')
@section('page-title') Главная @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')
    @include('components.homePage.buttonPanel')
    @include('components.homePage.slider')
</div>

<script src="/scripts/router.js"></script>
<script src="/scripts/api.js"></script>
<script src="/scripts/player.js"></script>
<script src="/scripts/sliderItems.js"></script>
<script src="/scripts/sliderScript.js"></script>
<script>
    const toggleContent = (e) => {
        clearSlider();
        setDefaultBtnColor();
        let owner = $("#login")[0].innerText;
        switch (e.target.id) {
            case "videoButton":
                Api.get("user_video", {
                        owner
                    })
                    .then(videos => {
                        console.log(videos);
                        videos.forEach(video => {
                            $(".slider_wrapper")
                                .append(videoHtml(video.id, video.photo, video.name, video.artistName));
                        });
                        onchangeSliderChildren();
                    });
                $(".slider").attr("data-typeItem", "video");
                break;
            case "albumButton":
                Api.get("user_album", {
                        owner
                    })
                    .then(albums => {
                        console.log(albums);
                        albums.forEach(album => {
                            $(".slider_wrapper")
                                .append(albumHtml(album.id, album.photo, album.name, album.artistName));
                        });
                        onchangeSliderChildren();
                    });
                $(".slider").attr("data-typeItem", "album");
                break;
            case "songButton":
                Api.get("user_song", {
                        owner
                    })
                    .then(songs => {
                        console.log(songs);
                        songs.forEach(song => {
                            $(".slider_wrapper").append(songHtml(song.id, song.photo, song.name, song.audio, song.artistName));
                        });
                        onchangeSliderChildren();
                    });

                $(".slider").attr("data-typeItem", "song");
                break;
        }
        e.target.style.color = "white";
    }

    const ready = () => {
        if (!sessionStorage.getItem("api_token")) {
            var req = new XMLHttpRequest();
            req.open('GET', document.location, false);
            req.send(null);
            var api_token = req.getResponseHeader("api_token");
            sessionStorage.setItem("api_token",api_token);
        }

        let owner = $("#login")[0].innerText;
        Api.get("user_song", {
                owner
            })
            .then(songs => {
                console.log(songs);
                songs.forEach(song => {
                    $(".slider_wrapper").append(
                        songHtml(song.id, song.photo, song.name, song.audio, song.artistName));
                });
                onchangeSliderChildren();
            });
        $("#songButton").css("color", "white");
        $(".slider").attr("data-typeItem", "song");


    }
    document.addEventListener("DOMContentLoaded", ready);
</script>
@endsection