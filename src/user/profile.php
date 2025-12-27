<?php
session_start();
include "connect.php";

// Kiểm tra là tk ngkhac hay tk ca nhan
if(isset($_GET["id"])){
  $userId = $_GET["id"];
  $sql_getUser = "SELECT * FROM users WHERE id='$userId'";
  $resultUser = mysqli_query($conn, $sql_getUser);
  $user = mysqli_fetch_assoc($resultUser);

  // Lấy các dữ liệu user khác
  $cityId = $user["city_id"];
  $fullname = $user["full_name"];
  $username = $user["username"];
  $bio = $user["bio"];
  $ava = $user["avatar"];
} else {
  $userId = $_SESSION["user"]["id"];
  $cityId = $_SESSION["user"]["city_id"];
  $fullname = $_SESSION["user"]["full_name"];
  $username = $_SESSION["user"]['username'];
  $bio = $_SESSION["user"]["bio"];
  $ava = $_SESSION["user"]["avatar"];
}


$sql_getCity = "SELECT * FROM cities WHERE id='$cityId'";
$resultCity = mysqli_query($conn, $sql_getCity);
$rowCity = mysqli_fetch_assoc($resultCity);

$sql_getRecipes = "SELECT * FROM recipes where user_id = '$userId' ORDER BY created_at DESC; ";
$resultRecipes = mysqli_query($conn, $sql_getRecipes); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Lưu, đăng và chia sẻ công thức món chay cùng cộng đồng bếp trên khắp thế
    giới - Foodora
  </title>

  <!-- main layout -->
  <link rel="stylesheet" href="../../public/css/mainLayout/mainlayout.css" />
  <link rel="stylesheet" href="../../public/css/mainLayout/header.css" />
  <link rel="stylesheet" href="../../public/css/mainLayout/sidebar.css" />
  <link rel="stylesheet" href="../../public/css/mainLayout/footer.css" />

  <!-- sides -->
  <link rel="stylesheet" href="../../public/css/sites/profile.css" />





  <!-- others-->
  <link rel="stylesheet" href="../../public/css/othersCss/famouskeyword.css" />
  <link rel="stylesheet" href="../../public/css/othersCss/articleslider.css" />

  <!-- icon, img, fav,... -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../fontawesome-free-7.1.0-web/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="../../public/images/logoNonText.png" />
</head>

<body>
  <!-- hanh bar bên trái  -->
  <div class="sidebar">
    <div class="sidebar-content">
      <!-- sidebar's header  -->
      <header class="sidebar-header">
        <a href="#" class="header-logo">
          <img src="../../public/images/logoNonText.png" alt="Error" />
        </a>
        <span>Foodora</span>
      </header>

      <!-- sidebar's selections -->
      <nav class="sidebar-nav">
        <ul class="sidebar-nav-list">
          <li class="nav-list-item">
            <a href="search.php" class="nav-link">
              <span class="material-symbols-rounded"> search </span>
              <span class="nav-label">Tìm kiếm</span>
            </a>
          </li>
          <li class="nav-list-item">
            <a href="" class="nav-link">
              <span class="material-symbols-rounded">book</span>
              <span class="nav-label">Kho món ngon của bạn</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Ô lưu trữ công thức  -->
      <nav class="library">
        <div class="library-search-box">
          <span class="material-symbols-rounded">search</span>
          <input type="text" placeholder="Tìm trong kho món ngon" />
        </div>

        <div class="library-list-container">
          <ul class="library-list">
            <li class="library-item" onclick="window.location.href='library.php'">
              <div class="icon-box">
                <span class="material-symbols-rounded">book</span>
              </div>
              <div class="text-info">
                <span class="title">Tất Cả</span>
                <span class="count">0 món</span>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <!-- Nội dung bên phải  -->
  <div class="mainBody">
    <div class="mainBody-content">
      <div class="header">
        <div class="back-btn">
          <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="user-box">
          <img class="user-box-img" src="<?php echo $_SESSION["user"]["avatar"]?>"
          alt="avata"
          onclick="show()"
          />
          <div class="dropdown" id="dropdown-menu">
            <div class="user-info">
              <img class="user-img" src="<?php echo $_SESSION["user"]["avatar"]?>"
              alt="avata-user"
              />
              <div class="user-name">
                <span class="one"><?php echo $_SESSION["user"]["full_name"];?></span>
                <span>@<?php echo $_SESSION["user"]['username'];?></span>
              </div>
            </div>
            <div class="menu-lists">
              <a href="profile.php">
                <i class="fa-regular fa-user"></i> Bếp cá nhân
              </a>
              <a href="main.php?page_layout=setting">
                <i class="fa-solid fa-gear"></i> Cài đặt
              </a>
              <a href="main.php?page_layout=feedback"><i class="fa-regular fa-paper-plane"></i> Gửi Góp Ý
              </a>
              <hr />
              <a href="main.php?page_layout=logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Thoát
              </a>
            </div>
          </div>
          <button class="new-dish" onclick="window.location.href='newRecipe.php'">
            <i class="fa-solid fa-plus"></i> Viết món mới
          </button>
        </div>
      </div>

      <!-- Nội dung chính -->
      <div class="main">
        <div class="mainProfile">
          <!-- Thông tin cá nhân -->
          <div class="mainProfile-data">
            <!-- Ava + name... -->
            <div class="mainProfile-individual">
              <img src="<?php echo $ava?>" alt="" class="profile-avatar" />

              <div class="profile-name">
                <h1 class="profile-fullname"><?php echo $fullname;?>
                </h1>
                <p class="profile-username">@<?php echo $username;?>
                </p>
                <p class="profile-address">
                  <i class="fa fa-location-arrow" aria-hidden="true"></i>
                  <?php echo $rowCity["city_name"];?>
                </p>
              </div>
              <p class="profile-more">...</p>
            </div>

            <div class="mainProfile-content" id="profileContent">
              <div class="mainProfile-text">
                <?php echo $bio?>
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
              <article class="recipe-card" onclick="window.location.href='recipe.php?id=<?php echo $recipe['id']; ?>'">
                <div class="recipe-content">
                  <div class="recipe-author">
                    <img src="<?php echo $ava; ?>" class="author-avatar" />
                    <span class="author-name">
                      <?php echo $fullname; ?>
                    </span>
                  </div>

                  <h3 class="recipe-title">
                    <?php echo $recipe['title']; ?>
                  </h3>
                  <p class="recipe-desc">
                    <?php echo $recipe['description']; ?>
                  </p>

                  <div class="recipe-meta">
                    <span>Chuẩn bị:
                      <?php echo $recipe['prep_time']; ?>
                    </span>
                    <span class="meta-dot">•</span>
                    <span>Khẩu phần:
                      <?php echo $recipe['portion']; ?>
                    </span>
                  </div>
                </div>

                <div class="recipe-media">
                  
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
        </div>
      </div>

      <!-- Footer -->
      <div class="footer">
        <div class="footer-about">
          <!-- <p class="text-foodora-1"><strong></strong></p> -->
          <h2 class="footer-title">Về Foodora</h2>
          <p class="foodter-text">
            Chúng tôi xây dựng nền tảng này với mong muốn lan toả
            <span class="font-bold">lối sống lành mạnh và bền vững</span>
            thông qua ẩm thực chay. Mỗi công thức và mỗi câu chuyện được chia
            sẻ đều hướng tới việc
            <span class="font-bold">giúp mọi người</span> tìm thấy niềm vui
            khi vào bếp, đồng thời nuôi dưỡng sự an yên cho bản thân, gia đình
            và môi trường.
          </p>
          <p class="text-foodora">
            Tại đây, cộng đồng yêu thích đồ chay có thể
            <span class="font-bold">kết nối, trao đổi</span> bí quyết nấu
            nướng và <span class="font-bold">truyền cảm hứng</span> cho nhau
            mỗi ngày 💗.
          </p>
        </div>

        <div class="footer-more">
          <!-- <p class="text-foodora-1"><strong>Tìm Hiểu Thêm</strong></p> -->
          <h2 class="footer-text">Tìm Hiểu Thêm</h2>
          <nav class="footer-links">
            <a class="link-more" href="#">Góp ý</a>
            <a class="link-more" href="#">Điều khoản dịch vụ</a>
            <a class="link-more" href="#">Hướng dẫn dành cho cộng đồng</a>
            <a class="link-more" href="#">Chính sách bảo mật</a>
            <a class="link-more" href="#">Những câu hỏi thường gặp</a>
          </nav>
        </div>

        <div class="copyright">
          <p><strong>Bản quyền</strong> © Foodora Inc. All Rights Reserved</p>
        </div>

        <div class="footer-imageback">
          <img src="../../public/images/img/footer.png" alt="" />
        </div>
      </div>
    </div>
  </div>
</body>

<!-- LINK TO JAVASCRIPT FILES -->
<script src="../../public/js/homeRedirect.js"></script>
<script src="../../public/js/loginRedirect.js"></script>
<script src="../../public/js/showInfo.js"></script>
<script src="../../public/js/goBack.js"></script>
<script src="../../public/js/icon_save.js"></script>

</html>