<?php
  include "connect.php";
  session_start();

  $user_id = $_SESSION["user"]["id"];
  $recipe_id = $_GET["id"];
  $sql_getAllRecipeSaved = "SELECT * FROM saved_recipes WHERE user_id='$user_id' and recipe_id='$recipe_id';";
  $result = mysqli_query($conn, $sql_getAllRecipeSaved);

  if(mysqli_num_rows($result) !== 0){
    echo "<script>alert('Đã thêm công thức');</script>";
    echo "<script>window.history.back();</script>";
    exit;
  } else {
    $sql_saveRecipe = "INSERT INTO `saved_recipes`(`user_id`, `recipe_id`, `saved_type_id`) VALUES ('$user_id','$recipe_id','1');";
    mysqli_query($conn, $sql_saveRecipe);
    echo "<script>alert('Công thức được thêm thành công.');</script>";
    echo "<script>window.history.back();</script>";
    exit;
  }
?>