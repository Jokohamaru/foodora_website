<?php
  include "login_gate.php";
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lưu, đăng và chia sẻ công thức món chay cùng cộng đồng bếp trên khắp thế giới - Foodora</title>
  <link rel="stylesheet" href="../fontawesome-free-7.1.0-web/css/all.min.css">
  </link>
  <link rel="icon" type="image/x-icon" href="../public/images/logoNonText.png">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: noto-sans, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, arial, sans-serif;
    }

    body {
      background-color: #999;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    select {
      border: none;
      background: transparent;
      font-size: 16px;
      cursor: pointer;
      line-height: 3px;
    }

    option {
      line-height: 2;
    }

    .login-box {
      max-width: 450px;
      width: 90%;
      box-shadow: 0 20px 60px;
      padding: 40px;
      margin: auto;
      border-radius: 12px;
      background-color: white;
    }

    .login-wrapper {
      display: flex;
      justify-content: center;
      flex-direction: column;
    }

    .login-box-lang {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
      position: relative;
    }

    h2 {
      text-align: center;
      color: #333;
      font-size: 24px;
      margin: 20px 0;
      font-weight: 600;
      font-weight: bold;
    }

    input {
      width: 100%;
      height: 45px;
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 0 15px;
      font-size: 15px;
    }

    button {
      background-color: #667eea;
      font-size: 16px;
      color: white;
      font-weight: 600;
      width: 100%;
      height: 45px;
      border-radius: 8px;
      border: none;
      cursor: pointer;

    }

    .continue-Gg {
      width: 100%;
      height: 45px;
      margin-top: 15px;
      color: white;
      font-size: 16px;
      background-color: #1f2937;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 30px;
      border: none;
      border-radius: 8px;
      cursor: pointer;

    }

    .login-box-lang i {
      position: absolute;
      right: 0;
      cursor: pointer;
      font-size: 18px;
      color: #666;
    }

    img {
      width: 200px;
      margin: 10px auto;
      display: block;
    }

    .continue-Gg i {
      position: absolute;
      left: 20px;
      font-size: 18px;
    }

    .continue {
      margin-top: 10px;
    }

    p {
      color: rgb(74, 74, 74);
      font-size: 13px;
      text-align: center;
      margin-top: 20px;
      line-height: 1.5;
    }

    p u {
      text-decoration: underline;
      color: rgb(74, 74, 74);
      cursor: pointer;
    }

    input {
      gap: 10px;
    }

    .login-wrapper-log {
      gap: 10px;
      display: flex;
      flex-direction: column;
    }
    #main-logo{
      height: 100%;
    }
    #main-logo:hover{
      cursor: pointer;
    }
    #notification{
      color: red;
      margin: 0px;
      text-align: left;
    }
    
  </style>
</head>

<body>
  <div class="login-box">
    <div class="login-box-lang">
      <select>
        <option>Việt Nam</option>
        <option>Trung Quốc</option>
        <option>Hàn Quốc</option>
        <option>Mỹ</option>
        <option>Pháp</option>
        <option>ThaiLand</option>
      </select>
      <i class="fa-solid fa-xmark" id="exitBtn"></i>
    </div>
    <div >
      <img id="main-logo" src="../public/images/fullogo.png" />
    </div>
    <div class="login-wrapper">
      <h2>Đăng nhập</h2>

      <form action="login_gate.php" method="post" class="login-wrapper-log">
        <input type="text" name="username" id="log" placeholder="Email hoặc số điện thoại" />
        <input type="password" name="password" placeholder="Mật khẩu" />
        <p id="notification"></p>
        <button id="loginBtn">Đăng nhập</button>
      </form>
    </div>
    <div class="continue">
      <button class="continue-Gg">
        <i class="fa-brands fa-google"></i>
        Tiếp tục với Google
      </button>
    </div class="login-wrapper-end">
    <p>Khi sử dụng Foodora, bạn đồng ý với<u> Điều Khoản Dịch Vụ & Chính Sách Bảo Mật</u> của chúng tôi</p>
  </div>
</body>

<script>
  const exitBtn = document.getElementById("exitBtn");
  const mainlogo = document.getElementById("main-logo");

  exitBtn.addEventListener("click", () => {
    window.location.href = "index.html";
  });

  mainlogo.addEventListener("click", () => {
    window.location.href = "index.html";
  });
</script>


</html>