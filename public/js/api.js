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
        let url = this.baseUrl + endpoint + `?`;
        for (var property in props) {
            url += `${property}=${props[property]}&`;
        }
        return $.ajax({
                url,
                headers: {
                    "Authorization": 'Bearer ' + localStorage.getItem("api_token"),
                    'Accept': 'application/json',
                }
            })
            .then(data => data?.data??[])
            .catch(() => console.log("FAIL"));
    },
    getOne(endpoint, id) {
        let url = this.baseUrl + endpoint + `/${id}`;
        return $.ajax({
                url,
                headers: {
                    "Authorization": 'Bearer ' + localStorage.getItem("api_token"),
                    'Accept': 'application/json',
                }
            }).then(data => data?.data??{})
            .catch(() => console.log("FAIL"));
    },
    post(endpoint, data) {
        let url = this.baseUrl + endpoint + "";
        return $.ajax({
                type: "POST",
                url,
                data,
                headers: {
                    "Authorization": 'Bearer ' + localStorage.getItem("api_token"),
                    'Accept': 'application/json',
                }
            })
            .then(data => data?.data??{})
            .catch(() => console.log("FAIL"));
    },
    delete(endpoint, id) {
        let url = this.baseUrl + endpoint + "/" + id;
        return $.ajax({
                type: "DELETE",
                url,
                headers: {
                    "Authorization": 'Bearer ' + localStorage.getItem("api_token"),
                    'Accept': 'application/json',
                }
            })
            .then(data => data?.data)
            .catch(() => console.log("FAIL"));
    },
}