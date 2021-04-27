export function scrollCb(cb) {
    return (event) => {
        if (Math.ceil(event.target.scrollTop) === event.target.scrollHeight - event.target.clientHeight) {
            let countOfItems = event.target.children.length;
            console.log(countOfItems);
            if (countOfItems % 10 === 0) {
                cb(countOfItems);
            }
        }
    }
}