import { Api } from './api.js';
import { songHtml } from './albumSongItems.js';
import { starMouseEnter, starMouseLeave } from './star.js';

let convertMsecToMin = (msec) => {
    let min = Math.floor(msec / 60000).toString();
    let sec = Math.floor(Math.floor(msec / 1000) % 60).toString();
    if (sec.length == 1)
        sec = "0" + sec;
    return min + ":" + sec;
}
let convertSecToHour = (sec) => {
    let hour = Math.floor(sec / 3600).toString();
    let min = Math.floor(Math.floor(sec / 60) % 60).toString();
    if (min.length == 1)
        min = "0" + min;
    return hour + ":" + min;
}

let likeAlbum = (id, e) => {
    if (!e.target.classList.contains("saved")) {
        Api.post(Api.endpoints.userAlbums, { id })
            .then(response => e.target.classList.add("saved"));
    }
}

function getAlbumInfoFromServer(id) {
    Api.getOne(Api.endpoints.albums, id)
        .then(response => {
            let album = response.data;
            $("#artistName")[0].textContent = album.artistName;
            $("#albumName")[0].textContent = album.name;
            $("#albumPhoto")[0].src = album.photo;
            if (album.saved) {
                $("#albumId")[0].classList.add("fas");
                $("#albumId")[0].classList.add("saved");
            } else
                $("#albumId")[0].classList.add("far");

            $("#albumId")[0].id = album.id;
            $("#songCount")[0].textContent = album.countOfTrack;
            $("#year")[0].textContent = album.releaseDate.substr(0, 4);
        });
    $('#albumId').mouseleave((e) => starMouseLeave(e));
    $('#albumId').mouseenter((e) => starMouseEnter(e));
    $('#albumId').click((e) => likeAlbum(e.target.id, e));
}

function getSongsFromServer(album) {
    let secAlbumTime = 0;
    Api.get(Api.endpoints.songs, { album })
        .then(response => {
            console.log(response);
            response.data.forEach(song => {
                secAlbumTime += Math.floor(song.time / 1000);
                $("#songsContainer")
                    .append(songHtml(song.numberInAlbum, song.name,
                        convertMsecToMin(song.duration), song.audio, song.id, song.saved));
            });
            $("#hourCount")[0].textContent = convertSecToHour(secAlbumTime);
        });
}
document.addEventListener("DOMContentLoaded", () => {
    let albumId = $("#albumParam")[0].innerHTML;
    console.log(`albumId ${albumId}`);
    getAlbumInfoFromServer(albumId);
    getSongsFromServer(albumId);
});
