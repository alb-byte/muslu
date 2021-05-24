import { Api } from './api.js';
import { scrollCb } from './scroll.js';
import {
    videoHtml,
    albumHtml,
} from './artistItems.js';
const albumNodes = $("#albumNodes");
const videoNodes = $("#videoNodes");

const artistId = $("#artistId")[0].innerHTML;

albumNodes.scroll(scrollCb((startFrom) => getAlbumsFromServer(artistId, startFrom)));
videoNodes.scroll(scrollCb((startFrom) => getVideosFromServer(artistId, startFrom)));

function getAlbumsFromServer(artistId, startFrom) {
    Api.get(Api.endpoints.albums, { artistId, startFrom })
        .then(response => response.data)
        .then(albums => {
            console.log(albums);
            albums.forEach(album => {
                $("#albumNodes").append(albumHtml(album.id, album.photo, album.name));
            });
        });
}
function getVideosFromServer(artistId, startFrom) {
    Api.get(Api.endpoints.videos, { artistId, startFrom })
        .then(response => response.data)
        .then(videos => {
            console.log(videos);
            videos.forEach(video => {
                $("#videoNodes").append(videoHtml(video.id, video.photo, video.name));
            });
        });
}

document.addEventListener("DOMContentLoaded", () => {
    Api.getOne(Api.endpoints.artists, artistId)
        .then(response => response.data)
        .then(artist => {
            console.log(artist);
            $("#artistName")[0].textContent = artist.name;
            $("#artistPhoto")[0].src = artist.photo;

            $("#instagram")[0].href = artist.instagram;
            $("#youtube")[0].href = artist.youtube;
            $("#twitter")[0].href = artist.twitter;

            $("#genre")[0].textContent = `Жанр: ${artist.genre}`;
            $("#biography")[0].textContent = `${artist.biography}`;

            getAlbumsFromServer(artistId);
            getVideosFromServer(artistId);
        });
});
