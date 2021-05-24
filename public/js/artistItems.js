import { redirect } from './router.js';
export function albumHtml(id, photo, name) {
    const element = $(`
    <div class="col-3" style="height:18vw;">
        <div id='${id}' class="row h-75 w-75" style="margin:auto;" onclick='Router.redirect("album",{id})'>
            <img class="col h-100" src="${photo}">
        </div>
        <div class="row h-25">
            <h6 class="col text-center">${name}</h6>
        </div>
    </div>`);
    element.find(`#${id}`).click((e) => redirect("album", { album: id }));
    return element;
}
export function videoHtml(id, photo, name) {
    const element = $(` <div class="col-3" style="height:15vw;">
        <div id='${id}' class="row h-75 w-75" style="margin:auto;" onclick='Router.redirect("video",{id})'>
            <img class="col h-100" src="${photo}">
        </div>
        <div class="row h-25">
            <h6 class="col text-center">${name}</h6>
        </div>
    </div>`);
    element.find(`#${id}`).click((e) => redirect("video", { video: id }));
    return element; 
}