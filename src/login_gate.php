<?php
  include("connect.php");

  if (isset($_POST["username"]) && isset($_POST["password"])){
    $userName = $_POST["username"];
    $userPassword = $_POST["password"];

    $sql_user = "select * from users where username ='$userName' and password = '$userPassword'";
    $result = mysqli_query($conn, $sql_user);

    if(mysqli_num_rows($result) == 0){
      echo "<script>
              document.getElementById('notification').innerText = 'Tên đăng nhập hoặc mật khẩu không đúng';
            </script>";
    } else {
      $row = $result->fetch_assoc();
      if ($row["role_id"] == 1){
        // Giao diện Admin
        $_SESSION["username"] = $userName;
        header('location: ./admin/administrator.php');
        exit();
      }
      // Giao diện User
      $_SESSION["username"] = $userName;
      header('location: home.html');
      exit();

      
    }
  }
?>