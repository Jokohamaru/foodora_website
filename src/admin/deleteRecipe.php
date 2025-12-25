<?php
$id = $_GET['id'];
$sql = "DELETE FROM recipes WHERE id = '$id'";
mysqli_query($conn, $sql);
header("Location: index.php?page_layout=recipe&id=$id");
exit;
