import {
    artistHtml,
    albumHtml,
    songHtml,
} from './searchItems.js';
import { Api } from './api.js';
import { scrollCb } from './scroll.js';

let artistNodes = $("#artistList");
let albumNodes = $("#albumList");
let songNodes = $("#songList");

function getArtistFromServer(name, startFrom) {
    Api.get(Api.endpoints.artists, {
        name,
        startFrom
    }).then(response => {
        response.forEach(artist => {
            artistNodes.append(artistHtml(artist.id, artist.name));
        });
    });
}
function getAlbumsFromServer(name, startFrom) {
    Api.get(Api.endpoints.albums, {
        name,
        startFrom
    }).then(response => {
        response.forEach(album => {
            albumNodes.append(albumHtml(album.id, album.name, album.artistName));
        });
    });
}
function getSongsFromServer(name, startFrom) {
    Api.get(Api.endpoints.songs, {
        name,
        startFrom
    }).then(response => {
        response.forEach(song => {
            songNodes.append(songHtml(song.id, song.name, song.audio, song.artistName, song.saved));
        });
    });
}

songNodes.scroll(scrollCb((startFrom) => {
    if ($("#data").val()) getSongsFromServer($("#data").val(), startFrom);
}));
albumNodes.scroll(scrollCb((startFrom) => {
    if ($("#data").val()) getAlbumsFromServer($("#data").val(), startFrom);
}));
artistNodes.scroll(scrollCb((startFrom) => {
    if ($("#data").val()) getArtistFromServer($("#data").val(), startFrom);
}));

export function ready() {
    let name = $("#data").val();
    getArtistFromServer(name, null);
    getAlbumsFromServer(name, null);
    getSongsFromServer(name, null);
};