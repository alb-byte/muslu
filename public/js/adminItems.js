export function videoHtml(video) {
    return `<div id='${video.id}'
        class="col mt-4 w-100 h-25 text-center adminItem">
        <div class="row h-100 align-items-center">
            <div class="col-12">
            Артист:${video.artistName}      Жанр:${video.genre}
            <br>
            Название:${video.name}<br>
            Рейтинг:${video.count}
            </div>
        </div>
    </div>`;
}
export function albumHtml(album) {
    return `<div id='${album.id}'
        class="col mt-4 w-100 h-25 text-center adminItem">
        <div class="row h-100 align-items-center">
        <div class="col-12">
        Артист:${album.artistName}  Жанр:${album.genre}  Песни:${album.countOfTrack}
        <br>
        Название:${album.name}<br>
        Рейтинг:${album.count}
        </div>
        </div>
    </div>`;
}
export function userHtml(user) {
    return `<div
    class="col mt-4 w-100 h-25 text-center adminItem">
    <div class="row h-100 align-items-center">
    <div class="col-12">
    Пользователь: ${user.name}
    <br>
    Почта: ${user.email}
    <br>
    Рейтинг: ${user.count}
    </div>
    </div>
    </div>`;
}
export function songHtml(song) {
    return `<div id='${song.id}'
    class="col mt-4 w-100 h-25 text-center adminItem">
    <div class="row h-100 align-items-center">
    <div class="col-12">
    Артист:${song.artistName}      Жанр:${song.genre}     Альбом:${song.albumName}
    <br>
    Название:${song.name}<br>
    Рейтинг:${song.count}
    </div>
    </div>
    </div>`;
}