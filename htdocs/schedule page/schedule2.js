
//in case that "panelContent" dose not expend correctly when window size changed
function onWindowSizeChanged() {


    var el = document.getElementsByClassName("panelContent");

    for (var i of el) {
        if (i.style.maxHeight) {
            i.style.maxHeight = i.scrollHeight + "px";
        }
    }

    var el_list = document.getElementsByClassName("slotList")[0];
    var el_container = document.getElementsByClassName("container")[0];
    var el_footer = document.getElementsByClassName("footer")[0];

    el_container.style.height = window.innerHeight - (el_container.offsetTop * 2) + "px";
    el_list.style.maxHeight = el_footer.offsetTop - el_list.offsetTop - 10 + "px";
}

onWindowSizeChanged();

window.onresize = onWindowSizeChanged;