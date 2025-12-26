<?php
  session_start();
  include "connect.php";

  // Kiểm tra session
  if(!isset($_SESSION["user"]["username"])){
    header("Location: ../index.html"); 
    exit();
  }
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

  <link rel="stylesheet" href="../../public/css/mainLayout/mainlayout.css" />
  <link rel="stylesheet" href="../../public/css/mainLayout/header.css" />
  <link rel="stylesheet" href="../../public/css/mainLayout/sidebar.css" />
  <link rel="stylesheet" href="../../public/css/mainLayout/footer.css" />
  <link rel="stylesheet" href="../../public/css/sites/newRecipe.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../fontawesome-free-7.1.0-web/css/all.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="../public/images/logoNonText.png" />

  <style>
    .additional-info-row {
      display: flex;
      gap: 20px;
    }

    .half-width {
      flex: 1;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="sidebar-content">
      <header class="sidebar-header">
        <a href="#" class="header-logo">
          <img src="../../public/images/logoNonText.png" alt="Error" />
        </a>
        <span>Foodora</span>
      </header>
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
      <nav class="library">
        <div class="library-search-box">
          <span class="material-symbols-rounded">search</span>
          <input type="text" placeholder="Tìm trong kho món ngon" />
        </div>
        <div class="library-list-container">
          <ul class="library-list">
            <li class="library-item">
              <div class="icon-box"><span class="material-symbols-rounded">book</span></div>
              <div class="text-info"><span class="title">Tất Cả</span><span class="count">0 món</span></div>
            </li>
            <li class="library-item">
              <div class="icon-box"><span class="material-symbols-rounded">bookmark</span></div>
              <div class="text-info"><span class="title">Đã Lưu</span><span class="count">0 món</span></div>
            </li>
            <li class="library-item">
              <div class="icon-box"><span class="material-symbols-rounded">check</span></div>
              <div class="text-info"><span class="title">Đã Nấu</span><span class="count">0 món</span></div>
            </li>
            <li class="library-item">
              <div class="icon-box"><span class="material-symbols-rounded">person</span></div>
              <div class="text-info"><span class="title">Món Của Tôi</span><span class="count">0 món</span></div>
            </li>
            
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <div class="mainBody">
    <div class="mainBody-content">
      <div class="header">
        <div class="back-btn">
          <i class="fa-solid fa-chevron-left"></i>
        </div>
        <h1 class="page-title">Thêm Công Thức Mới</h1>

        <div class="user-box">
          <img class="user-box-img" src="<?php echo $_SESSION["user"]["avatar"]?>" alt="avata" onclick="show()" />
          <div class="dropdown" id="dropdown-menu">
            <div class="user-info">
              <img class="user-img" src="<?php echo $_SESSION["user"]["avatar"]?>" alt="avata-user" />
              <div class="user-name">
                <span class="one"><?php echo $_SESSION["user"]["full_name"];?></span>
                <span>@<?php echo $_SESSION["user"]['username'];?></span>
              </div>
            </div>
            <div class="menu-lists">
              <a href="main.php?page_layout=profile"> <i class="fa-regular fa-user"></i> Bếp cá nhân </a>
              <a href="main.php?page_layout=setting"> <i class="fa-solid fa-gear"></i> Cài đặt </a>
              <a href="main.php?page_layout=feedback"><i class="fa-regular fa-paper-plane"></i> Gửi Góp Ý</a>
              <hr />
              <a href="main.php?page_layout=logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Thoát</a>
            </div>
          </div>
          <button class="new-dish">
            <i class="fa-solid fa-plus"></i> Viết món mới
          </button>
        </div>
      </div>


      <div class="main">
        <div class="mainNewRecipe">

          <form action="newRecipe.php" method="POST" enctype="multipart/form-data">

            <div class="top-section">
              <div class="cover-image-col">
                <label class="form-label">Ảnh bìa món ăn</label>
                <div class="cover-upload-box">
                  <div class="upload-placeholder" id="upload-placeholder">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>Tải ảnh món ăn</p>
                  </div>
                  <img id="img-preview" src="#" alt="Ảnh bìa">
                  <input type="file" id="file-upload-input" name="cover_image" accept="image/*">
                </div>
              </div>

              <div class="info-col">
                <div class="form-group">
                  <label class="form-label">Tên món ăn</label>
                  <input type="text" class="form-control" name="recipe_title" placeholder="Ví dụ: Phở bò chay..." required>
                </div>

                <div class="form-group">
                  <label class="form-label">Mô tả ngắn</label>
                  <textarea class="form-control" name="recipe_description" placeholder="Hãy chia sẻ điều gì đó thú vị về món ăn này..."></textarea>
                </div>

                <div class="additional-info-row">
                  <div class="form-group half-width">
                    <label class="form-label">Thời gian nấu</label>
                    <input type="text" class="form-control" name="prep_time" placeholder="VD: 45 phút">
                  </div>

                  <div class="form-group half-width">
                    <label class="form-label">Khẩu phần</label>
                    <input list="suggestions" class="form-control" name="portion" placeholder="Nhập món ăn...">
                    <datalist id="suggestions">
                      <option value="1 người">
                      <option value="2 người">
                      <option value="3 người">
                      <option value="4 người">
                    </datalist>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="section-title">Nguyên liệu</div>
              <div id="ingredients-list">
                <div class="ingredient-row">
                  <input type="text" class="form-control ing-name" name="ingredient_names[]" placeholder="Tên nguyên liệu">
                  <input type="text" class="form-control ing-qty" name="ingredient_quantities[]" placeholder="Số lượng">
                  <button type="button" class="btn-trash"><i class="fa-solid fa-trash-can"></i></button>
                </div>
                <div class="ingredient-row">
                  <input type="text" class="form-control ing-name" name="ingredient_names[]" placeholder="Tên nguyên liệu">
                  <input type="text" class="form-control ing-qty" name="ingredient_quantities[]" placeholder="Số lượng">
                  <button type="button" class="btn-trash"><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
              <button type="button" id="add-ing-btn" class="btn-add">+ Thêm nguyên liệu</button>
            </div>

            <div class="steps-container">
              <div class="section-title">Các bước thực hiện</div>
              <div id="steps-list">
                <div class="step-row">
                  <div class="step-num">1</div>
                  <textarea name="step_descriptions[]" class="form-control-step" placeholder="Nhập hướng dẫn cách làm..."></textarea>
                  <div class="step-upload-box">
                    <div class="upload-placeholder">
                      <i class="fa-solid fa-camera"></i>
                    </div>
                    <img class="step-img-preview" src="#" alt="Ảnh bước">
                    <input type="file" name="step_images[]" class="step-file-input" accept="image/*">
                    <label class="text-step-input">Ảnh bước 1</label>
                  </div>
                </div>

                <div class="step-row">
                  <div class="step-num">2</div>
                  <textarea name="step_descriptions[]" class="form-control-step" placeholder="Nhập hướng dẫn cách làm..."></textarea>
                  <div class="step-upload-box">
                    <div class="upload-placeholder">
                      <i class="fa-solid fa-camera"></i>
                    </div>
                    <img class="step-img-preview" src="#" alt="Ảnh bước">
                    <input type="file" name="step_images[]" class="step-file-input" accept="image/*">
                    <label class="text-step-input">Ảnh bước 2</label>
                  </div>
                </div>
                <div class="step-row">
                  <div class="step-num">3</div>
                  <textarea name="step_descriptions[]" class="form-control-step" placeholder="Nhập hướng dẫn cách làm..."></textarea>
                  <div class="step-upload-box">
                    <div class="upload-placeholder">
                      <i class="fa-solid fa-camera"></i>
                    </div>
                    <img class="step-img-preview" src="#" alt="Ảnh bước">
                    <input type="file" name="step_images[]" class="step-file-input" accept="image/*">
                    <label class="text-step-input">Ảnh bước 3</label>
                  </div>
                </div>
              </div>
              <button type="button" id="add-step-btn" class="btn-add">+ Thêm bước</button>
            </div>

            <div class="form-actions">
              <button type="button" class="btn-draft">Lưu nháp</button>
              <button type="submit" name="submit_recipe" class="btn-publish">Đăng công thức</button>
            </div>

          </form>

          <?php

          if (isset($_POST['submit_recipe'])) {

            if (!empty($_POST['recipe_title']) && !empty($_POST['recipe_description'])) {

              $user_id = isset($_SESSION["user"]['id']) ? $_SESSION["user"]['id'] : 1;
              $title = $_POST['recipe_title'];
              $desc = $_POST['recipe_description'];

              $prep_time = isset($_POST['prep_time']) ? $_POST['prep_time'] : "";
              $portion = isset($_POST['portion']) ? $_POST['portion'] : "";

              $target_dir = "uploads/";
              if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
              }

              $cover_image_path = "";

              if (isset($_FILES["cover_image"]) && $_FILES["cover_image"]["error"] == 0) {
                $target_file = $target_dir . time() . "_" . basename($_FILES["cover_image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
                if ($check !== false) {
                  $uploadOk = 1;
                } else {
                  echo "<script>alert('File ảnh bìa không phải là ảnh.');</script>";
                  $uploadOk = 0;
                }

                if ($_FILES["cover_image"]["size"] > 5000000) {
                  echo "<script>alert('File ảnh bìa quá lớn.');</script>";
                  $uploadOk = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                  echo "<script>alert('Chỉ chấp nhận file JPG, JPEG, PNG & GIF cho ảnh bìa.');</script>";
                  $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                  if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
                    $cover_image_path = $target_file;
                  } else {
                    echo "<script>alert('Có lỗi khi tải ảnh bìa lên.');</script>";
                  }
                }
              }

              $sql_recipe = "INSERT INTO `recipes` (`user_id`, `title`, `description`, `cover_image`, `prep_time`, `portion`, `status`) 
                             VALUES ('$user_id', '$title', '$desc', '$cover_image_path', '$prep_time', '$portion', 'published')";

              if (mysqli_query($conn, $sql_recipe)) {
                $recipe_id = mysqli_insert_id($conn);

                // XỬ LÝ NGUYÊN LIỆU
                if (isset($_POST['ingredient_names']) && isset($_POST['ingredient_quantities'])) {
                  $ing_names = $_POST['ingredient_names'];
                  $ing_qtys = $_POST['ingredient_quantities'];

                  for ($i = 0; $i < count($ing_names); $i++) {
                    $i_name = $ing_names[$i];
                    $i_qty = $ing_qtys[$i];

                    if (!empty($i_name)) {
                      $sql_ing = "INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`) 
                                  VALUES ('$recipe_id', '$i_name', '$i_qty')";
                      mysqli_query($conn, $sql_ing);
                    }
                  }
                }

                // XỬ LÝ CÁC BƯỚC
                if (isset($_POST['step_descriptions'])) {
                  $step_descs = $_POST['step_descriptions'];

                  for ($i = 0; $i < count($step_descs); $i++) {
                    $s_desc = $step_descs[$i];
                    $s_num = $i + 1;
                    $s_img_path = "";

                    if (isset($_FILES['step_images']['name'][$i]) && $_FILES['step_images']['error'][$i] == 0) {
                      $stepFileName = time() . "_step_" . $s_num . "_" . basename($_FILES['step_images']['name'][$i]);
                      $stepTargetFile = $target_dir . $stepFileName;
                      $stepUploadOk = 1;
                      $stepFileType = strtolower(pathinfo($stepTargetFile, PATHINFO_EXTENSION));

                      $checkStep = getimagesize($_FILES['step_images']['tmp_name'][$i]);
                      if ($checkStep !== false) {
                        if ($stepFileType != "jpg" && $stepFileType != "png" && $stepFileType != "jpeg" && $stepFileType != "gif") {
                          $stepUploadOk = 0;
                        }
                      } else {
                        $stepUploadOk = 0;
                      }

                      if ($stepUploadOk == 1) {
                        if (move_uploaded_file($_FILES['step_images']['tmp_name'][$i], $stepTargetFile)) {
                          $s_img_path = $stepTargetFile;
                        }
                      }
                    }

                    if (!empty($s_desc) || !empty($s_img_path)) {
                      // Lưu ý: Kiểm tra tên cột mô tả trong bảng steps là 'description' hay 'instruction' như đã nhắc ở trên
                      $sql_step = "INSERT INTO `steps` (`recipe_id`, `step_number`, `instruction`, `image_url`) 
                                   VALUES ('$recipe_id', '$s_num', '$s_desc', '$s_img_path')";
                      mysqli_query($conn, $sql_step);
                    }
                  }
                }

                echo '<script>alert("Thêm công thức thành công!"); window.location.href = "newRecipe.php";</script>';
              } else {
                echo "Lỗi: " . $sql_recipe . "<br>" . mysqli_error($conn);
              }
            } else {
              echo "<script>alert('Vui lòng nhập tên món và mô tả!');</script>";
            }
          }
          ?>
        </div>
      </div>

      <div class="footer">
        <div class="footer-about">
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
        <div class="footer-imageback"><img src="../../public/images/img/footer.png" alt="" /></div>
      </div>
    </div>
  </div>

  <script>
    const imgInput = document.getElementById('file-upload-input');
    const imgPreview = document.getElementById('img-preview');
    const placeHolder = document.getElementById('upload-placeholder');

    imgInput.addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
          placeHolder.style.display = 'none';
        }
        reader.readAsDataURL(file);
      }
    });

    const stepsList = document.getElementById('steps-list');
    if (stepsList) {
      stepsList.addEventListener('change', function(event) {
        if (event.target.classList.contains('step-file-input')) {
          const file = event.target.files[0];
          const parentBox = event.target.closest('.step-upload-box');
          const stepPreview = parentBox.querySelector('.step-img-preview');
          const stepPlaceholder = parentBox.querySelector('.upload-placeholder');

          if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
              stepPreview.src = e.target.result;
              stepPreview.style.display = 'block';
              stepPlaceholder.style.display = 'none';
              parentBox.style.borderStyle = 'solid';
            }
            reader.readAsDataURL(file);
          } else {
            stepPreview.src = "#";
            stepPreview.style.display = 'none';
            stepPlaceholder.style.display = 'block';
            parentBox.style.borderStyle = 'dashed';
          }
        }
      });
    }
    const addIngBtn = document.getElementById('add-ing-btn');
    const ingList = document.getElementById('ingredients-list');

    if (addIngBtn && ingList) {
      addIngBtn.addEventListener('click', function() {
        const currentRows = ingList.getElementsByClassName('ingredient-row').length;

        if (currentRows >= 10) {
          alert("Bạn chỉ được thêm tối đa 10 nguyên liệu!");
          return;
        }

        const newRow = document.createElement('div');
        newRow.classList.add('ingredient-row');
        newRow.innerHTML = `
        <input type="text" class="form-control ing-name" name="ingredient_names[]" placeholder="Tên nguyên liệu">
        <input type="text" class="form-control ing-qty" name="ingredient_quantities[]" placeholder="Số lượng">
        <button type="button" class="btn-trash" onclick="removeIng(this)"><i class="fa-solid fa-trash-can"></i></button>
      `;

        ingList.appendChild(newRow);
      });
    }

    function removeIng(btn) {
      btn.parentElement.remove();
    }

    const addStepBtn = document.getElementById('add-step-btn');
    const stepList = document.getElementById('steps-list');

    if (addStepBtn && stepList) {
      addStepBtn.addEventListener('click', function() {
        // Đếm số bước hiện tại
        const currentSteps = stepList.getElementsByClassName('step-row').length;

        if (currentSteps >= 5) {
          alert("Bạn chỉ được thêm tối đa 5 bước thực hiện!");
          return;
        }

        const nextStepNum = currentSteps + 1;

        const newStep = document.createElement('div');
        newStep.classList.add('step-row');

        newStep.innerHTML = `
        <div class="step-num">${nextStepNum}</div>
        <textarea name="step_descriptions[]" class="form-control-step" placeholder="Nhập hướng dẫn cách làm..."></textarea>
        
        <div class="step-upload-box">
          <div class="upload-placeholder">
            <i class="fa-solid fa-camera"></i>
          </div>
          <img class="step-img-preview" src="#" alt="Ảnh bước">
          <input type="file" name="step_images[]" class="step-file-input" accept="image/*">
          <label class="text-step-input">Ảnh bước ${nextStepNum}</label>
        </div>
      `;

        stepList.appendChild(newStep);
      });
    }
  </script>
</body>
<script src="../../public/js/showInfo.js"></script>
<script src="../../public/js/goBack.js"></script>
<script src="../../public/js/homeRedirect.js"></script>

</html>