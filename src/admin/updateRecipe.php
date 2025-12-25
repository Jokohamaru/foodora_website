<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phim Mới</title>
    <style>
        main{
            width: 50%;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #39a13eff;
            margin-bottom: 20px;
        }
 
        form div {
            margin-bottom: 15px;
        }

        form p {
            margin: 0 0 5px;
            font-weight: bold;
            color: #333;
        }
 
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            min-height: 80px;
            resize: none;
        }

         
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #39a13e;
        }

        
        input[type="submit"] {
            background: #39a13e;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #2e7d32;
        }

        .avatar-box {
            width: 150px;
            height: 150px;
            border: 2px dashed #39a13e;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: #f9f9f9;
        }
        .avatar-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }
        .avatar-text {
            color: #777;
            font-size: 14px;
            text-align: center;
            position: absolute;
        }

    </style>
</head>
<body>
    <?php
     if (isset($_GET['id'])) {
        $id =  $_GET['id'];
    } elseif (isset($_POST['id'])) {
        $id =  $_POST['id'];
    } else {
        die('Không thấy ID recipe');
    }
     $sql = "SELECT * FROM recipes WHERE id = '$id' ";
     $result = mysqli_query($conn,$sql);
     $recipe = mysqli_fetch_array($result);
    ?>
    <main>
        <h1>Update recipe</h1>
        <form action="index.php?page_layout=updateRecipe" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $recipe['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $recipe['user_id']; ?>">
            
            <div>
                <p>Title</p>
                <input name="title" type="text" value="<?php echo $recipe['title']?>" >
            </div>

            <div>
                <p>Description</p>
                <textarea name="description"><?php echo $recipe['description'] ?></textarea>
            </div>
            <div>
                <p>Cover image</p>

                <label for="fileToUpload" class="avatar-box">
                    <img id="previewAvatar"
                        src="<?php echo $recipe['cover_image']?>"
                        id="previewAvatar"
                        style="display: block">
                    <span class="avatar-text"
                        style="<?php echo !empty($recipe['cover_image']) ? 'display:none;' : ''; ?>">
                        Click để chọn ảnh
                    </span>
                </label>

                <input type="file"
                    name="fileToUpload"
                    id="fileToUpload"
                    accept="image/*"
                    hidden>
            </div>

            <div>
                <p>Prep_time</p>
                <input name="preptime" type="text" value="<?php echo $recipe['prep_time']?>" >
                 
            </div>

            <div>
                <p>Portion</p>
                 <input name="portion" type="text" value="<?php echo $recipe['portion']?>" >
            </div>

            <div>
                <p>Status</p>
                <select name="status">
                    
                    <option value="draft" 
                        <?php echo ($recipe['status'] == 'draft') ? 'selected' : ''; ?>>
                        Draft
                    </option>

                    <option value="published" 
                        <?php echo ($recipe['status'] == 'published') ? 'selected' : ''; ?>>
                        Published
                    </option>

                    <option value="hidden" 
                        <?php echo ($recipe['status'] == 'hidden') ? 'selected' : ''; ?>>
                        Hidden
                    </option>

                </select>
            </div>

            <br>
            <div>
                <input type="submit" name="submit"  value="Update recipe">
            </div>
        </form>

        <?php
             
              if(isset($_POST['submit'])){

                 $id = (int)$_POST['id'];
                      
                    if(  
                        !empty($_POST['title']) &&
                        !empty($_POST['description']) &&
                        !empty($_POST['preptime']) &&
                        !empty($_POST['portion']) &&
                        !empty($_POST['status'])){
                            $user_id= $_POST['user_id'];
                            $title= $_POST['title'];
                            $description= $_POST['description'];
                            $preptime= $_POST['preptime'];
                            $portion =$_POST['portion'];
                            $status= $_POST['status'];
                             
                             
                    #Bắt đầu xử lý thêm ảnh
                    // Xử lý ảnh
                    if (!empty($_FILES["fileToUpload"]["name"])) {
                        // Nhánh để lưu ảnh
                        $target_dir = "../../public/images/uploads/users/";
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                        // Kiểm tra xem file ảnh có hợp lệ không
                        if(isset($_POST["submit"])) {
                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                            if($check !== false) {
                                $uploadOk = 1;
                            } else {
                                echo "File không phải là ảnh.";
                                $uploadOk = 0;
                            }
                        }
                
                        // Kiểm tra nếu file đã tồn tại
                        if (file_exists($target_file)) {
                            echo "File này đã tồn tại trên hệ thông";
                            $uploadOk = 2;
                        }
                
                        // Kiểm tra kích thước file
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo "File quá lớn";
                            $uploadOk = 0;
                        }
                
                        // Cho phép các định dạng file ảnh nhất định
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                            echo "Chỉ những file JPG, JPEG, PNG & GIF mới được chấp nhận.";
                            $uploadOk = 0;
                        }
                         
    
                        #Kết thúc xử lý ảnh
                        if($uploadOk == 0){
                            echo "File của bạn chưa được tải lên";
                        }
                        else{
                            //Code logic cũ để xử lý insert DB
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        
                                $sql = "UPDATE `recipes` SET  `title`='$title',`description`='$description',
                                `cover_image`='$target_file',`prep_time`='$preptime',
                                `portion`='$portion',`status`='$status'  WHERE id ='$id'";
    
                                echo $sql;
                                mysqli_query($conn, $sql);
    
                                echo '<script>window.location.href = "index.php?page_layout=recipe&id=' . $user_id . '";</script>';
                                
                            }   
                        }
                    }else{
                     $sql = "UPDATE `recipes` SET   `title`='$title',`description`='$description',
                     `prep_time`='$preptime',`portion`='$portion',`status`='$status'  WHERE id ='$id'";
    
                        mysqli_query($conn, $sql);
                        echo '<script>window.location.href = "index.php?page_layout=recipe&id=' . $user_id . '";</script>';
                    }
         
                    }
                    else{
                        echo " Vui lòng nhập  đủ thông tin ";
                    }
              }
        ?>
    </main>
    <script>
        document.getElementById('fileToUpload').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Vui lòng chọn file ảnh');
                return;
            }

            const img = document.getElementById('previewAvatar');
            const text = document.querySelector('.avatar-text');

            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
            text.style.display = 'none';
        });
    </script>

</body>
</html>