export let Api = {
    endpoints: {
        artists: "artists",
        albums: "albums",
        songs: "songs",
        videos: "videos",
    }, 
    baseUrl: "/api/",
    get(endpoint, props) {
        let token = sessionStorage.getItem("api_token");
        let url = this.baseUrl + endpoint + `?api_token=${token}&`;
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
        let url = this.baseUrl + endpoint + "";
        return $.ajax({
            type: "POST",
            url,
            data
        })
            .then(data => JSON.parse(data))
            .then(obj => obj)
            .catch(() => console.log("FAIL"));
    },
    delete(endpoint, props) {
        let url = this.baseUrl + endpoint + "?";
        for (var property in props) {
            url += `${property}=${props[property]}&`;
        }
        return $.ajax({
            type: "DELETE",
            url
        })
            .then(data => JSON.parse(data))
            .then(obj => obj)
            .catch(() => console.log("FAIL"));
    },
}