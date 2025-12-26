<?php
// Giả sử bạn đã có biến kết nối $conn

// 1. Lấy thông tin thành phố của người dùng
$cityId = $_SESSION["user"]["city_id"]; // Hãy chắc chắn dùng city_id thay vì id của user nếu logic DB yêu cầu
$sql_getCity = "SELECT * FROM cities WHERE id='$cityId'";
$resultCity = mysqli_query($conn, $sql_getCity);
$rowCity = mysqli_fetch_assoc($resultCity);

$userId = $_SESSION["user"]["id"];
$sql_getRecipes = "SELECT * FROM recipes where user_id = '$userId' ORDER BY created_at DESC; ";
$resultRecipes = mysqli_query($conn, $sql_getRecipes); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/public/css/sites/profile.css">
  <link rel="stylesheet" href="/public/css/sites/search.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
  <div class="mainProfile">
  <!-- Thông tin cá nhân -->
  <div class="mainProfile-data">
    <!-- Ava + name... -->
    <div class="mainProfile-individual">
      <img src="<?php echo $_SESSION["user"]["avatar"]?>" alt="" class="profile-avatar" />

      <div class="profile-name">
        <h1 class="profile-fullname"><?php echo $_SESSION["user"]["full_name"];?></h1>
        <p class="profile-username">@<?php echo $_SESSION["user"]['username'];?></p>
        <p class="profile-address">
          <i class="fa fa-location-arrow" aria-hidden="true"></i> <?php echo $rowCity["city_name"];?>
        </p>
      </div>
      <p class="profile-more">...</p>
    </div>

    <div class="mainProfile-content" id="profileContent">
      <div class="mainProfile-text">
        <?php echo $_SESSION["user"]["bio"]?>
        <div>
          <?php echo $_SESSION["user"]["bio"]?>
        </div>
      </div>
    </div>
  </div>

  <!-- Nút sửa thông tin cá nhân (Tài khoản của mình) or Kết bạn (Tài khoản người khác) -->
  <div class="fixProfileData-btn">
    <button>Sửa thông tin cá nhân</button>
  </div>

  <!-- Các công thức -->
  <div class="mainProfile-selections">
  <div class="finding-results" style="width: 100%"> 

    <?php 
    // Kiểm tra xem biến $resultRecipes có tồn tại và có dữ liệu không
    if (isset($resultRecipes) && mysqli_num_rows($resultRecipes) > 0) {
        while($recipe = mysqli_fetch_assoc($resultRecipes)) { 
    ?>
        <article class="recipe-card" onclick="window.location.href='recipe_detail.php?id=<?php echo $recipe['id']; ?>'">
          <div class="recipe-content">
            <div class="recipe-author">
              <img src="<?php echo $_SESSION["user"]["avatar"]; ?>" class="author-avatar" />
              <span class="author-name"><?php echo $_SESSION["user"]["full_name"]; ?></span>
            </div>

            <h3 class="recipe-title"><?php echo $recipe['title']; ?></h3>
            <p class="recipe-desc"><?php echo $recipe['description']; ?></p>

            <div class="recipe-meta">
              <span>Chuẩn bị: <?php echo $recipe['prep_time']; ?></span>
              <span class="meta-dot">•</span>
              <span>Khẩu phần: <?php echo $recipe['portion']; ?></span>
            </div>
          </div>

          <div class="recipe-media">
            <button class="recipe-save" onclick="toggleSave(event, this)">
              <i class="fa-regular fa-bookmark"></i>
            </button>
            <img src="<?php echo $recipe['cover_image']; ?>" class="recipe-thumb" />
          </div>
        </article>
    <?php 
        } 
    } else { 
    ?>
        <p style="text-align: center; padding: 20px; width: 100%;">Người dùng này chưa có món ăn nào.</p>
    <?php 
    } 
    ?>

  </div>
</div>
</body>
</html>