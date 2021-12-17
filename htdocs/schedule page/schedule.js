
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

function onClick(el) {
    document.getElementById("submit").removeAttribute("disabled");
    document.getElementById("selection").textContent = el.getAttribute("data-datetime");

    //adjust slot list height
    var el_list = document.getElementsByClassName("slotList")[0];
    var el_footer = document.getElementsByClassName("footer")[0];

    el_list.style.maxHeight = el_footer.offsetTop - el_list.offsetTop - 10 + "px";
}

function onPanelHeaderClick(el) {
    var s = el.nextElementSibling;

    if (s.style.maxHeight) {
        el.classList.remove("active");
        s.style.maxHeight = null;
    } else {
        el.classList.add("active");
        s.style.maxHeight = s.scrollHeight + "px";
    }

    /*

    var els = document.getElementsByClassName("panelHeader");

    if (el.nextElementSibling.style.maxHeight) {
        el.classList.remove("active");
        el.nextElementSibling.style.maxHeight = null;
    } else {
        for (var i of els) {
            var s = i.nextElementSibling;

            if (el == i) {
                i.classList.add("active");
                s.style.maxHeight = s.scrollHeight + "px";
            } else {
                i.classList.remove("active");
                s.style.maxHeight = null;
            }
        }
    }
    */
}

onWindowSizeChanged();

window.onresize = onWindowSizeChanged;