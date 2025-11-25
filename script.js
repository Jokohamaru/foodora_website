const sideBar = document.querySelector(".sidebar-content");
const toggleBtn = document.querySelector(".sidebar-toggler");

toggleBtn.addEventListener("click", () => {
  sideBar.classList.toggle("closed");
});
