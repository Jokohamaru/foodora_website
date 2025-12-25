<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background: #f5f6fa;
            padding: 20px;
             
        }
        h1 {
            margin-bottom: 15px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 15px;

        }

        .btn {
            display: inline-block;
            background: #39a13eff;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #65aa4aff;
        }

        th {
            background: #39a13eff;
            color: #fff;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            vertical-align: middle;
        }

        

        td img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        td .btn {
            margin-right: 5px;
            background: #16a34a;
        }

        td .btn:last-child {
            background: #dc2626;
        }

        td .btn:last-child:hover {
            background: #b91c1c;
        }

        td.bio {
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        td.actions {
            white-space: nowrap;
        }
        td.datetime {
            white-space: nowrap;
            display: table-cell;   
        }
    </style>
</head>
<body>
     
     <?php
       
        if (isset($_GET['id'])) {
            $id_user_check = $_GET['id'];
 
            $sql = "SELECT re.*, us.username FROM `recipes` re 
                    JOIN `users` us on re.user_id = us.id 
                    WHERE re.user_id = $id_user_check 
                    ORDER BY re.id;";
                    
            $result = mysqli_query($conn, $sql);
            $numbers_recipe = mysqli_num_rows($result);

            if ($numbers_recipe > 0) {
            ?>
                    <h1>Danh sách công thức</h1>
                    <a class="btn" href="index.php?page_layout=addRecipe">Add recipe</a>
                    <table border=1>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Cover_image</th>
                            <th>Prep_time</th>
                            <th>Portion</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Actions</th> </tr>
                        <?php
                             
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td>
                                <img src="<?php echo $row['cover_image'] ?>" width="100" alt=""> 
                            </td>
                            <td><?php echo $row['prep_time'] ?></td>
                            <td><?php echo $row['portion'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td class="datetime"><?php echo $row['created_at'] ?></td>
                            <td class="datetime"><?php echo $row['updated_at'] ?></td>
                            <td class="actions">
                                <a class="btn" href="index.php?page_layout=updateRecipe&id=<?php echo $row['id'] ?>">Update</a>
                                <a class="btn" style="background: red;" href="index.php?page_layout=deleteRecipe&id=<?php echo $row['id'] ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    <?php
                } 
                
                else {
            ?>
                    <div style="text-align: center; margin-top: 70px;">
                        <h3>Người dùng này chưa có công thức nào!</h3>
                        <p>Hãy tạo công thức đầu tiên cho họ.</p>
                        <br>
                        <a class="btn" href="index.php?page_layout=addRecipe" style="padding: 13px 19px; font-size: 16px;">
                            + Add recipe
                        </a>
                    </div>
            <?php
                }
            }  
        ?>

</body>
</html>