import { Api } from './api.js';
import { AudioPlayer } from './player.js';
import { redirect } from './router.js';

const svg = ` <svg version="1.1" id="hexagon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 184.751 184.751" style="enable-background:new 0 0 184.751 184.751;" xml:space="preserve">
<path d="M0,92.375l46.188-80h92.378l46.185,80l-46.185,80H46.188L0,92.375z"/>
<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
<g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                    </svg>`;

const toggleSongState = (event) => {
    let element = event.currentTarget;
    if (element.dataset.songstatus == "false") {
        element.children[1].classList.remove("fa-play");
        element.children[1].classList.add("fa-pause");

        element.dataset.songstatus = "true";
    } else {
        element.children[1].classList.remove("fa-pause");
        element.children[1].classList.add("fa-play");
        element.dataset.songstatus = "false"
    }
    AudioPlayer.play(element.id, element.dataset.song);
}
const deleteItem = (event) => {
    let item = event.currentTarget;
    if (confirm("Вы точно хотите удалить выбранный элемент?")) {
        Api.delete(`user_${item.dataset.type}`, item.id);
        $(".slider_wrapper").children(`#${item.id}`).remove();
    }
}
export function songHtml(id, photo, name, audio, artistName) {
    let element = $(`
    <div id='${id}' class="slider_item">
        <div class="hover">
            <div class="messager">
                <p id='${id}' class='startBtn' data-songstatus='false' data-song='${audio}' >
                ${svg}
                    <i id="link" class="fas fa-play"></i>
                </p>
                <p id='${id}' class='deleteBtn' data-type='songs'>
                ${svg}
                    <i id="link" class="fas fa-trash-alt"></i>
                </p>
            </div>
            <img class="itemPhoto" src="${photo}"/>
        </div>
        <div class="info">
            <div class="name">${name}</div>
            <div class="additionalInfo">${artistName}</div>
        </div>
    </div>`);
    element.find('p.startBtn').click((e) => toggleSongState(e));
    element.find('p.deleteBtn').click((e) => deleteItem(e));
    return element;
}

export function albumHtml(id, photo, name, artistName) {
    let element = $(`
    <div id='${id}' class="slider_item">
        <div class="hover">
            <div class="messager">
                <p class="redirectBtn">
                ${svg}
                    <i id="link" class="fas fa-record-vinyl"></i>
                </p>
                <p id='${id}' class='deleteBtn' data-type='albums' >
                ${svg}
                    <i id="link" class="fas fa-trash-alt"></i>
                </p>
            </div>
            <img class="itemPhoto" src="${photo}"/>
        </div>
        <div class="info">
            <div class="name">${name}</div>
            <div class="additionalInfo">${artistName}</div>
        </div>
    </div>`);
    element.find('p.redirectBtn').click((e) => redirect("album", { album: id }));
    element.find('p.deleteBtn').click((e) => deleteItem(e));
    return element;
}

export function videoHtml(id, photo, name, artistName) {
    let element = $(`
    <div id='${id}' class="slider_item">
        <div class="hover">
            <div class="messager">
                <p class="redirectBtn">
                ${svg}
                    <i id="link" class="fas fa-video"></i>
                </p>
                <p id='${id}' class='deleteBtn' data-type='videos' >
                ${svg}
                    <i id="link" class="fas fa-trash-alt"></i>
                </p>
            </div>
            <img class="itemPhoto" src="${photo}"/>
        </div>
        <div class="info">
            <div class="name">${name}</div>
            <div class="additionalInfo">${artistName}</div>
        </div>
    </div>`);
    element.find('p.redirectBtn').click((e) => redirect("video", { video: id }));
    element.find('p.deleteBtn').click((e) => deleteItem(e));
    return element;
}