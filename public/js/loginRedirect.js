//login button
const loginBtn = document.querySelector(".button-gr-login");
const newDishBtn = document.querySelector(".new-dish");
const findDish = document.querySelector(".findingbox-btn");

const loginTransaction = (button) => {
  button.addEventListener("click", () => {
    window.location.href = "login.php";
  });
}

loginTransaction(loginBtn);
loginTransaction(newDishBtn);
loginTransaction(findDish);

document.getElementById("notification").innerText = "Tên đăng nhập hoặc mật khẩu không đúng";

//search button