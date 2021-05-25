export let Api = {
    endpoints: {
        artists: "artists",
        albums: "albums",
        songs: "songs",
        videos: "videos",
        userSongs: "user_songs",
        userAlbums: "user_albums",
        userVideos: "user_videos",
        admin: "admin"
    },
    baseUrl: "/api/",
    get(endpoint, props) {
        let token = sessionStorage.getItem("api_token");
        let url = this.baseUrl + endpoint + `?`;
        for (var property in props) {
            url += `${property}=${props[property]}&`;
        }
        return $.ajax({
            url,
            headers: {
                "Authorization": 'Bearer ' + token,
                'Accept': 'application/json',
            }
        })
            .then(data => data)
            .catch(() => console.log("FAIL"));
    },
    getOne(endpoint, id) {
        let token = sessionStorage.getItem("api_token");
        let url = this.baseUrl + endpoint + `/${id}`;
        return $.ajax({
            url,
            headers: {
                "Authorization": 'Bearer ' + token,
                'Accept': 'application/json',
            }
        }).then(data => data)
            .catch(() => console.log("FAIL"));
    },
    post(endpoint, data) {
        let token = sessionStorage.getItem("api_token");
        let url = this.baseUrl + endpoint + "";
        console.log(data);
        return $.ajax({
            type: "POST",
            url,
            data,
            headers: {
                "Authorization": 'Bearer ' + token,
                'Accept': 'application/json',
            }
        })
            // .then(data => JSON.parse(data))
            .then(obj => obj)
            .catch(() => console.log("FAIL"));
    },
    delete(endpoint, id) {
        let token = sessionStorage.getItem("api_token");
        let url = this.baseUrl + endpoint + "/" + id;
        return $.ajax({
            type: "DELETE",
            url,
            headers: {
                "Authorization": 'Bearer ' + token,
                'Accept': 'application/json',
            }
        })
            .then(obj => obj)
            .catch(() => console.log("FAIL"));
    },
}