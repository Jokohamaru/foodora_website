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
    <main>
        <h1>Add recipe</h1>
        <form action="index.php?page_layout=addRecipe" method="post" enctype="multipart/form-data">
            
            <div>
                <p>User</p>
                <select name="username">
                    <option value="">-- Choosen user --</option>
                    <?php
                        $sqlDD = "SELECT * FROM `users`";
                        $resultDD = mysqli_query($conn, $sqlDD);
                        while($rowDD = mysqli_fetch_array($resultDD)){
                            echo "<option value='{$rowDD['id']}'>{$rowDD['username']}</option>";
                        }
                    ?>
                </select>
            </div>
 
            <div>
                <p>Title</p>
                <input name="title" type="text"  >
            </div>

            <div>
                <p>Description</p>
                <textarea name="description"></textarea>
            </div>

             <div>
                <p>Cover image</p>

                <label for="fileToUpload" class="avatar-box">
                    <img id="previewAvatar"
                        src=""
                        alt="Avatar preview">
                    <span class="avatar-text">Click để chọn ảnh</span>
                </label>

                <input type="file"
                    name="fileToUpload"
                    id="fileToUpload"
                    accept="image/*"
                    hidden>
            </div>

            <div>
                <p>Prep_time</p>
                <input name="preptime" type="text"  >
            </div>

            <div>
                <p>Portion</p>
                 <input name="portion" type="text">
            </div>
            <div>
                <p>Status</p>
                <select name="status"  >
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="h    idden">Hidden</option>

                </select>
            </div>


            <br>
            <div>
                <input type="submit" name="submit"  value="Add recipe">
            </div>
        </form>

        <?php
                if( !empty($_POST['username'])&& 
                    !empty($_POST['title']) &&
                    !empty($_POST['description']) &&
                    !empty($_POST['preptime']) &&
                    !empty($_POST['portion']) &&
                    !empty($_POST['status']) ){
                        $username= $_POST['username'];
                        $title= $_POST['title'];
                        $description= $_POST['description'];
                        $preptime= $_POST['preptime'];
                        $portion= $_POST['portion'];
                        $status= $_POST['status'];
                         
                         
                #Bắt đầu xử lý thêm ảnh
                // Xử lý ảnh
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
                echo "3";

                #Kết thúc xử lý ảnh
                if($uploadOk == 0){
                    echo "File của bạn chưa được tải lên";
                }
                else{
                    //Code logic cũ để xử lý insert DB
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                 
                         $sql = "INSERT INTO `recipes`( `user_id`, `title`, `description`, `cover_image`, `prep_time`, `portion`, `status` )
                          VALUES ('$username','$title','$description','$target_file','$preptime','$portion','$status' )";
                        echo $sql;
                        mysqli_query($conn, $sql);

                        echo '<script>window.location.href = "index.php?page_layout=user";</script>';
                        
                    }   
                }
     
                }
                else{
                    echo " Vui lòng nhập  đủ thông tin ";
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