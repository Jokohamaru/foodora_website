<?php
  session_start();
  include "connect.php";

  if(!isset($_SESSION["user"]["username"])){
    header("Location: ../index.html"); 
    exit();
  }

  $sql_getRecipes = $sql = "SELECT \n"

  . "    r.id AS recipe_id,\n"

  . "    r.title,\n"

  . "    r.cover_image,\n"

  . "    r.description,\n"

  . "    u.full_name AS author_name,  -- Đổi tên alias để không nhầm với tên người đang xem\n"

  . "    u.avatar AS author_avatar,\n"

  . "    s.created_at AS saved_at,     -- Thời gian lưu\n"

  . "    st.type_name AS collection_name -- (Tùy chọn) Tên bộ sưu tập nếu có\n"

  . "FROM saved_recipes s\n"

  . "-- Join 1: Lấy thông tin món ăn\n"

  . "JOIN recipes r ON s.recipe_id = r.id \n"

  . "-- Join 2: Lấy thông tin TÁC GIẢ bài viết (người đăng món)\n"

  . "JOIN users u ON r.user_id = u.id\n"

  . "-- Join 3 (Optional): Lấy tên bộ sưu tập (Ví dụ: Món sáng, Tiệc tùng...)\n"

  . "LEFT JOIN saved_types st ON s.saved_type_id = st.id\n"

  . "ORDER BY s.created_at DESC;";
  $result = mysqli_query($conn, $sql_getRecipes);
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

  <link rel="stylesheet" href="../../public/css/sites/library.css" />




  <!-- others-->
  <link rel="stylesheet" href="../../public/css/othersCss/famouskeyword.css" />

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
            <a href="main.php?page_layout=search" class="nav-link">
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
            <li class="library-item" onclick="window.location.href='main.php?page_layout=library'">
              <div class="icon-box">
                <span class="material-symbols-rounded">book</span>
              </div>
              <div class="text-info">
                <span class="title">Tất Cả</span>
                <span class="count">0 món</span>
              </div>
            </li>

            <li class="library-item" onclick="window.location.href='main.php?page_layout=library&type=saved'">
              <div class="icon-box">
                <span class="material-symbols-rounded">bookmark</span>
              </div>
              <div class="text-info">
                <span class="title">Đã Lưu</span>
                <span class="count">0 món</span>
              </div>
            </li>

            <li class="library-item" onclick="window.location.href='main.php?page_layout=library&type=cooked'">
              <div class="icon-box">
                <span class="material-symbols-rounded">check</span>
              </div>
              <div class="text-info">
                <span class="title">Đã Nấu</span>
                <span class="count">0 món</span>
              </div>
            </li>

            <li class="library-item" onclick="window.location.href='main.php?page_layout=library&type=authored'">
              <div class="icon-box">
                <span class="material-symbols-rounded">person</span>
              </div>
              <div class="text-info">
                <span class="title">Món Của Tôi</span>
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
          <img
            class="user-box-img"
            src="<?php echo $_SESSION["user"]["avatar"]?>"
            alt="avata"
            onclick="show()"
          />
          <div class="dropdown" id="dropdown-menu">
            <div class="user-info">
              <img
                class="user-img"
                src="<?php echo $_SESSION["user"]["avatar"]?>"
                alt="avata-user"
              />
              <div class="user-name">
                <span class="one"><?php echo $_SESSION["user"]["full_name"];?></span>
                <span>@<?php echo $_SESSION["user"]['username'];?></span>
              </div>
            </div>
            <div class="menu-lists">
              <a href="main.php?page_layout=profile">
                <i class="fa-regular fa-user"></i> Bếp cá nhân
              </a>
              <a href="main.php?page_layout=setting">
                <i class="fa-solid fa-gear"></i> Cài đặt
              </a>
              <a href="main.php?page_layout=feedback"
                ><i class="fa-regular fa-paper-plane"></i> Gửi Góp Ý
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
        <div class="library-wrapper">
          <!-- Ô trả về các công thức -->
          <div class="library-recipes">
            <div class="header">
              <h3>Tất cả (1)</h3>
              <form action="main.php?page_layout=library&" method="get">
                <input type="text" name="keyword" placeholder="Tìm trong kho món ngon của bạn">
              </form>
            </div>

            <?php
              while($row = mysqli_fetch_array($result)){
            ?>
            <div class="recipe-card" onclick="window.location.href='recipe.php?id=<?php echo $row['recipe_id']?>'">
              <img src="<?php echo $row["cover_image"]?>" alt="recipe">
              <div class="recipe-info">
                <h4><?php echo $row["title"]?></h4>
                <p><?php echo $row["description"]?></p>
                <span><?php echo $row["saved_at"]?></span>
              </div>
            </div>

            <?php
              }
            ?>
          </div>


          <!-- bảng lấy feedback -->
          <div class="feedback">
            <div class="feedback-text">Giúp chúng tôi cải thiện dịch vụ</div>

            <div class="feedback-reason">
              Foodora luôn không ngừng hoàn thiện dịch vụ để khiến bạn hài
              lòng hơn. Rất mong nhận được phản hồi của bạn để Foodora có thể
              cải thiện tốt hơn :3 .
              <br /><br />
              Nếu bạn có câu hỏi hay gặp vấn đề gì, vui lòng mở
              <a href="#" class="feedback-link">Trang FAQ</a>.
            </div>

            <textarea class="feedback-place" placeholder="Vui lòng ghi góp ý của bạn ở đây..."></textarea>

            <input class="feedback-input" type="submit" value="Gửi" />

            <div class="feedback-warning">
              <p>
                Vui lòng không đưa bất kỳ thông tin nhận dạng cá nhân nào (dữ
                liệu cá nhân) vào biểu mẫu phản hồi này, bao gồm tên hoặc chi
                tiết liên hệ của bạn.
              </p>

              <p>
                Chúng tôi sẽ sử dụng thông tin này để giúp chúng tôi cải thiện
                dịch vụ của mình. Bằng cách gửi phản hồi này, bạn đồng ý xử lý
                thông tin của mình theo
                <a href="#" class="feedback-link">Chính Sách Bảo Mật</a> và
                <a href="#" class="feedback-link">Điều Khoản Dịch Vụ</a> của
                chúng tôi.
              </p>
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