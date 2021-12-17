function onClick(el) {
    document.getElementById("submit").removeAttribute("disabled");
    document.getElementById("selection").textContent = el.getAttribute("data-datetime");
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