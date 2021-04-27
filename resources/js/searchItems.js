import {redirect} from './router.js';
import {starMouseEnter,starMouseLeave} from './star.js';
import {AudioPlayer} from './player.js';
import {Api} from './api.js';

function songClick(event) {
    let element = event.currentTarget;
    if (element.dataset.songstatus == "false") {
        element.classList.remove("fa-play");
        element.classList.add("fa-pause");
        element.dataset.songstatus = "true";
    } else {
        element.classList.remove("fa-pause");
        element.classList.add("fa-play");
        element.dataset.songstatus = "false"
    }
    AudioPlayer.play(element.dataset.id, element.dataset.song);
}
function likeSong(e) {
    if (!e.target.classList.contains("saved")) {
        Api.post("user_song", {
            songId: e.currentTarget.dataset.id
        })
            .then(response => console.log(response));
        e.target.classList.add("saved");
    }
}
function albumClick(event) {
    redirect(event.currentTarget.dataset.type, { album: event.currentTarget.id });
}
function artistClick(event) {
    redirect(event.currentTarget.dataset.type, { id: event.currentTarget.id });
}
export function artistHtml(id, name) {
    let element = $(`<div id='${id}'
        data-type='artist'
        class="col mt-4 w-100 h-25 text-center searchItem">
        <div class="row h-100 align-items-center">
            <div class="col-12">
            ${name}
            </div>
        </div>
    </div>`);
    element.click((e)=>artistClick(e));
    return element;
}
export function albumHtml(id, name, artist) {
    let element = $(`<div id='${id}'
        data-type='album'
        class="col mt-4 w-100 h-25 text-center searchItem">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                ${artist}
                <br>
                ${name}
                </div>
            </div>
    </div>`);
    element.click((e) => albumClick(e));
    return element;
}
export function songHtml(id, name, audio, artist, saved) {
    let star = null;
    if (saved) star = "fas saved";
    else star = "far";
    let element = $(`<div id='${id}'
        class="col mt-4 w-100 h-25 text-center searchItem">
        <div class="row h-75 align-items-center">
            <div class="col-12">
                ${artist}
                <br>
                ${name}
                <br>
                <i class="fas fa-play"
                data-song='${audio}'
                data-id='${id}'
                data-songstatus='false'>
                </i>
                <i style="color:#FEFF77;"data-id='${id}'
                class="col-1 ${star} fa-star fa-1x">
                </i>
            </div>
        </div>
    </div>`);
    element.find('i.fa-play').click((e)=>songClick(e));
    let starElement = element.find('i.fa-star');
    starElement.click((e)=>likeSong(e));
    starElement.mouseleave((e)=>starMouseLeave(e));
    starElement.mouseenter((e)=>starMouseEnter(e));
    return element;
}