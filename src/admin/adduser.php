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
    </style>
</head>
<body>
    <main>
        <h1>Add user</h1>
        <form action="index.php?page_layout=adduser" method="post" enctype="multipart/form-data">
            
            <div>
                <p>Role</p>
                <select name="role">
                    <option value="">-- Choosen role --</option>
                    <?php
                        $sqlDD = "SELECT * FROM `roles`";
                        $resultDD = mysqli_query($conn, $sqlDD);
                        while($rowDD = mysqli_fetch_array($resultDD)){
                            echo "<option value='{$rowDD['id']}'>{$rowDD['role_name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div>
                <p>City</p>
                <select name="city">
                    <option value="">-- Choosen city --</option>
                    <?php
                        $sqlD = "SELECT * FROM `cities`";
                        $resultD = mysqli_query($conn, $sqlD);
                        while($rowD = mysqli_fetch_array($resultD)){
                            echo "<option value='{$rowD['id']}'>{$rowD['city_name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div>
                <p>Username</p>
                <input name="username" type="text"  >
            </div>

            <div>
                <p>Email</p>
                <input name="email" type="email"  >
            </div>

            <div>
                <p>Password</p>
                <input name="password" type="password"  >
            </div>

            <div>
                <p>Fullname</p>
                 <input name="fullname" type="text">
            </div>

            <div>
                <p>Avatar</p>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>

            <div>
                <p>Bio</p>
                <textarea name="bio"></textarea>
            </div>

            <br>
            <div>
                <input type="submit" name="submit"  value="Add user">
            </div>
        </form>

        <?php
                if( !empty($_POST['role'])&& 
                    !empty($_POST['city']) &&
                    !empty($_POST['username']) &&
                    !empty($_POST['email']) &&
                    !empty($_POST['password']) &&
                    !empty($_POST['fullname']) &&
                    !empty($_POST['bio'])){
                        $role= $_POST['role'];
                        $city= $_POST['city'];
                        $username= $_POST['username'];
                        $email= $_POST['email'];
                        $password= $_POST['password'];
                        $fullname= $_POST['fullname'];
                        $bio= $_POST['bio'];
                         
                echo "1"; 
                #Bắt đầu xử lý thêm ảnh
                // Xử lý ảnh
                $target_dir = "uploads/";
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
                 
                         $sql = "INSERT INTO `users`
                            (`role_id`, `city_id`, `username`, `email`, `password`, `full_name`, `avatar`, `bio`) 
                            VALUES 
                            ('$role', '$city', '$username', '$email', '$password', '$fullname', '$target_file', '$bio' )";
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
</body>
</html>