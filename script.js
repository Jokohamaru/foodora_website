//in-out sidebar
const sideBar = document.querySelector(".sidebar-content");
const toggleBtn = document.querySelector(".sidebar-toggler");

toggleBtn.addEventListener("click", () => {
  sideBar.classList.toggle("closed");
});

//login button
const loginBtn = document.querySelector(".button-gr-login");
const newDishBtn = document.querySelector(".new-dish");
const findDish = document.querySelector(".find");

const loginTransaction = (button)=>{
  button.addEventListener("click", ()=>{
    window.location.href = "loginSite.html";
  });
}
loginTransaction(loginBtn);
loginTransaction(newDishBtn);
loginTransaction(findDish);
