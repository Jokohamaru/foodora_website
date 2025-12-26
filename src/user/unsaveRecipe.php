<?php
  include "connect.php";
  session_start();

  $user_id = $_SESSION["user"]["id"];
  $recipe_id = $_GET["id"];

  $sql_unsaveRecipe = "DELETE FROM saved_recipes WHERE user_id='$user_id' and recipe_id='$recipe_id';";
  mysqli_query($conn, $sql_unsaveRecipe);
  header("Location: library.php");
  exit;
?>