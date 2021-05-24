import { Api } from './api.js';

export const playVideo = (event) => {
    let videoPlayer = $("#myvideo")[0];
    let element = event.currentTarget;
    if (videoPlayer.paused) {
        videoPlayer.play();
        element.classList.remove("fa-play");
        element.classList.add("fa-pause");
    } else {
        videoPlayer.pause();
        element.classList.remove("fa-pause");
        element.classList.add("fa-play");
    }
}

export const likeVideo = (videoId, e) => {
    if (!e.target.classList.contains("saved")) {
        Api.post("user_video", { videoId })
            .then(response => console.log(response));
        e.target.classList.add("saved");
    }
}
document.addEventListener("DOMContentLoaded", () => {
    let videoPlayer = $("#myvideo")[0];
    Api.getOne(Api.endpoints.videos, $("#parm")[0].innerText)
        .then(response => response.data)
        .then(video => {
            videoPlayer.poster = video.photo;
            let srcElement = document.createElement("source");
            srcElement.src = video.video;
            srcElement.type = "video/mp4";
            videoPlayer.append(srcElement);
            if (video.saved) {
                $("#videoId")[0].classList.add("fas");
                $("#videoId")[0].classList.add("saved");
            } else
                $("#videoId")[0].classList.add("far");
            $("#videoId")[0].id = video.id;

            subscribeChangeStars();

        });
});
