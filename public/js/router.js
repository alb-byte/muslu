export function redirect(page, props) {
    let url = page + ".php?";
    for (var property in props) {
        url += `${property}=${props[property]}&`;
    }
    window.location = url;
}
