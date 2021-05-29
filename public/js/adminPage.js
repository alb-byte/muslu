import { songHtml, albumHtml, userHtml, videoHtml } from './adminItems.js';
import { Api } from './api.js';

function clearList() { $("#itemList").empty() }
function setDefaultBtnColor() { $(".control").css("color", "#FEFF77") }
const toggleContent = (e) => {
    clearList();
    setDefaultBtnColor();
    const map = new Map();
    map.set("videoButton", { props: { video: true }, template: videoHtml });
    map.set("albumButton", { props: { album: true }, template: albumHtml });
    map.set("songButton", { props: { song: true }, template: songHtml });
    map.set("userButton", { props: { user: true }, template: userHtml });
    const { props, template } = map.get(e.target.id);

    Api.get(Api.endpoints.admin, props)
        .then(items => {
            items?.forEach(item => {
                itemNodes.append(template(item));
            });
        });
    e.target.style.color = "white";
}
let itemNodes = $("#itemList");
export function ready() {
    Api.get(Api.endpoints.admin, { song: true })
        .then(songs => {
            console.log(songs);
            songs?.forEach(song => {
                itemNodes.append(songHtml(song));
            });
        });
    $('.control').click((e) => toggleContent(e));
    document.getElementById("songButton").style.color = "white";
}
