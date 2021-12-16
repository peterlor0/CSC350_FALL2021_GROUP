function adjustContainerPos() {
    var el = document.getElementsByClassName("container")[0];

    var windowHeight = window.innerHeight;
    var containerHeight = el.offsetHeight;

    if (containerHeight > windowHeight) {
        el.style.top = "0px";
    } else {
        el.style.top = ((windowHeight - containerHeight) / 3) + "px";
    }
}

adjustContainerPos();

window.onresize = adjustContainerPos;