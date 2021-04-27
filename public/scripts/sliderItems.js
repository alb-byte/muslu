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
        Api.delete(`user_${item.dataset.type}`, {
            id: item.id
        });
        $(".slider_wrapper").children(`#${item.id}`).remove();
    }
}
const songHtml = (id, photo, name, audio, artistName) => {
    return (`
    <div id='${id}' class="slider_item">
    <div class="hover">
        <div class="messager">
            <p id='${id}' data-songstatus='false' data-song='${audio}' onclick='toggleSongState(event)' >
            ${svg}
                <i id="link" class="fas fa-play"></i>
            </p>
            <p id='${id}' data-type='song' onclick='deleteItem(event)' >
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
</div>
`)
}

const albumHtml = (id, photo, name, artistName) => {
    return (`
    <div id='${id}' class="slider_item">
    <div class="hover">
        <div class="messager">
            <p onclick='Router.redirect("album",{id:${id}})'>
            ${svg}
                <i id="link" class="fas fa-record-vinyl"></i>
            </p>
            <p id='${id}' data-type='album' onclick='deleteItem(event)' >
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
</div>
`)
}

const videoHtml = (id, photo, name, artistName) => {
    return (`
    <div id='${id}' class="slider_item">
    <div class="hover">
        <div class="messager">
            <p onclick='Router.redirect("video",{id:${id}})'>
            ${svg}
                <i id="link" class="fas fa-video"></i>
            </p>
            <p id='${id}' data-type='video' onclick='deleteItem(event)' >
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
</div>
`)
}