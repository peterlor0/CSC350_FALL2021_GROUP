function onClick(el) {
    document.getElementById("submit").removeAttribute("disabled");
    var text = el.value;
    text = text.split(" ")[0] + " ";
    document.getElementById("selection").textContent = text + el.parentElement.textContent;
}