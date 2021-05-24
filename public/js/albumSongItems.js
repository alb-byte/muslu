import { starMouseEnter, starMouseLeave } from './star.js';
import { AudioPlayer } from './player.js';
import { Api } from './api.js';

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

export function songHtml(number, name, time, audio, id, saved) {
    let star = null;
    if (saved) star = "fas saved";
    else star = "far";
    let element = $(
        ` <div id='${id}' 
            class="row align-items-center w-100 ml-auto mr-auto mt-3 albumSongItem">
            <div class="col-1 text-center">${number}</div>
            <div class="col-1 text-center" >
                <i class="fas fa-play"
                  data-song='${audio}'
                  data-songstatus='false'
                  data-id='${id}'></i>
            </div>
            <div class="col-7 text-center">
                ${name}
            </div>
            <div class="col-2 text-center">
                ${time}
            </div>
            <i style="color:#FEFF77;" 
            class="col-1 ${star} fa-star fa-1x"></i>
        </div>`);
    element.find('i.fa-play').click((e) => songClick(e));
    let starElement = element.find('i.fa-star');
    starElement.click((e) => likeSong(e));
    starElement.mouseleave((e) => starMouseLeave(e));
    starElement.mouseenter((e) => starMouseEnter(e));
    return element;
};