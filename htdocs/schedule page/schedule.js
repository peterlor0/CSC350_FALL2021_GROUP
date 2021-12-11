function onClick(el) {
    document.getElementById("submit").removeAttribute("disabled");

    document.getElementById("selection").textContent = el.getAttribute("data-datetime");
}