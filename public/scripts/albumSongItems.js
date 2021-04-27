const toggleSongState = (event) => {
    let element = event.currentTarget;
    if (element.dataset.songstatus == "false") {
        element.children[0].classList.remove("fa-play");
        element.children[0].classList.add("fa-pause");

        element.dataset.songstatus = "true";
    } else {
        element.children[0].classList.remove("fa-pause");
        element.children[0].classList.add("fa-play");
        element.dataset.songstatus = "false"
    }
    AudioPlayer.play(element.parentNode.id, element.dataset.song);
}

const likeSong = (songId, e) => {
    if (!e.target.classList.contains("saved")) {
        Api.post("user_song", {
                songId
            })
            .then(response => console.log(response));
        e.target.classList.add("saved");
    }
}
const songHtml = (number, name, time, audio, id, saved) => {
    let star = null;
    if (saved) star = "fas saved";
    else star = "far";
    return ` <div id='${id}' class="row align-items-center w-100 ml-auto mr-auto mt-3 albumSongItem">
            <div class="col-1 text-center">
                ${number}
            </div>
            <div class="col-1 text-center" 
            data-song='${audio}'
            data-songstatus='false'
            onclick='toggleSongState(event)'>
                <i class="fas fa-play"></i>
            </div>

            <div class="col-7 text-center">
                ${name}
            </div>
            <div class="col-2 text-center">
                ${time}
            </div>
            <i style="color:#FEFF77;" onclick="likeSong(parentNode.id,event)"
            class="col-1 ${star} fa-star fa-1x">
            </i>
    </div>`;
};