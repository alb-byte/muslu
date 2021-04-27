export function starMouseEnter(e) {
    if (!e.target.classList.contains("saved")) {
        e.target.classList.remove("far");
        e.target.classList.add("fas");
    }
}
export function starMouseLeave(e) {
    if (!e.target.classList.contains("saved")) {
        e.target.classList.remove("fas");
        e.target.classList.add("far");
    }
}