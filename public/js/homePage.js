import { Api } from './api.js';
import { songHtml, albumHtml, videoHtml } from './sliderItems.js';
import { onchangeSliderChildren, clearSlider, setDefaultBtnColor } from './sliderScript.js';

export function toggleContent(e) {
    clearSlider();
    setDefaultBtnColor();
    switch (e.target.id) {
        case "videoButton":
            Api.get(Api.endpoints.userVideos, {})
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
            Api.get(Api.endpoints.userAlbums, {})
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
            Api.get(Api.endpoints.userSongs, {})
                .then(songs => {
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

export function ready() {
    if (!localStorage.getItem("api_token")) {
        var req = new XMLHttpRequest();
        req.open('GET', document.location, false);
        req.send(null);
        var api_token = req.getResponseHeader("api_token");
        localStorage.setItem("api_token", api_token);
    }

    Api.get(Api.endpoints.userSongs)
        .then(songs => {
            songs.forEach(song => {
                $(".slider_wrapper").append(
                    songHtml(song.id, song.photo, song.name, song.audio, song.artistName));
            });
            onchangeSliderChildren();
        });
    $("#songButton").css("color", "white");
    $(".slider").attr("data-typeItem", "song");
}