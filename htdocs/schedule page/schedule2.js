
//in case that "panelContent" dose not expend correctly when window size changed
function onWindowSizeChanged() {
    var el = document.getElementsByClassName("panelContent");

    for (var i of el) {
        if (i.style.maxHeight) {
            i.style.maxHeight = i.scrollHeight + "px";
        }
    }
}

window.onresize = onWindowSizeChanged;