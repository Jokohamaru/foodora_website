function show() {
    var menu = document.getElementById("dropdown-menu");
    menu.classList.toggle("show");
}
window.onclick = function (event) {
    if (!event.target.matches(".user-box-img")) {
        var menu = document.getElementById("dropdown-menu");
        if (menu && menu.classList.contains("show")) {
            menu.classList.remove("show");
        }
    }
};