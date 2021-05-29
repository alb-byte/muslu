import { Api } from './api.js';
import { songHtml } from './albumSongItems.js';
import { starMouseEnter, starMouseLeave } from './star.js';

function timeConvert(fullTimeInSec) {
    const hours = Math.floor(fullTimeInSec / 60 / 60);
    const minutes = Math.floor(fullTimeInSec / 60) - (hours * 60);
    const seconds = fullTimeInSec % 60;
    return [
        hours.toString().padStart(2, '0') + 'ч',
        minutes.toString().padStart(2, '0') + 'м',
        seconds.toString().padStart(2, '0') + 'с'
    ].join(' ');
}

let likeAlbum = (id, e) => {
    if (!e.target.classList.contains("saved")) {
        Api.post(Api.endpoints.userAlbums, { id });
        e.target.classList.add("saved");
    }
}

function getAlbumInfoFromServer(id) {
    Api.getOne(Api.endpoints.albums, id)
        .then(album => {
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
            response.forEach(song => {
                secAlbumTime += Math.floor(song.duration / 1000);
                let time = timeConvert(Math.floor(song.duration / 1000));
                $("#songsContainer")
                    .append(songHtml(
                        song.numberInAlbum,
                        song.name,
                        `${time.split(' ')[1]} ${time.split(' ')[2]}`,
                        song.audio,
                        song.id,
                        song.saved
                    ));
            });
            $("#duration")[0].textContent = timeConvert(secAlbumTime);
        });
}
export function ready() {
    let albumId = $("#albumParam")[0].innerHTML;
    getAlbumInfoFromServer(albumId);
    getSongsFromServer(albumId);
};