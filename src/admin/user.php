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

        td .btn:nth-child(2) {
            background: #dc2626;
        }

        td .btn:nth-child(2):hover {
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
    <h1>Nguoi dung</h1>
    <a class="btn" href="index.php?page_layout=adduser">Add user</a>
    <table border=1>
        <tr>
            <th>Id</th>
            <th>Role</th>
            <th>City</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Fullname</th>
            <th>Avatar</th>
            <th>Bio</th>
            <th>Create_at</th>
            <th>Update_at</th>
             
        </tr>
        <?php
            $sql="SELECT us.*, ro.role_name,ci.city_name FROM `users` us 
            JOIN `roles` ro on us.role_id = ro.id 
            JOIN `cities` ci on us.city_id = ci.id
            ORDER BY us.id;";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['role_name'] ?></td>
            <td><?php echo $row['city_name'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['password'] ?></td>
            <td><?php echo $row['full_name'] ?></td>
            <td>
                <img src="<?php echo $row['avatar'] ?>" width="250" alt=""> 
            </td>
            <td class="bio"><?php echo $row['bio'] ?></td>
            <td class="datetime"><?php echo $row['created_at'] ?></td>
            <td class="datetime"><?php echo $row['updated_at'] ?></td>
            <td class="actions">
                <a class="btn" href="index.php?page_layout=capnhat&id=<?php echo $row['id'] ?>">Update</a>
                <a class="btn" href="index.php?page_layout=deleteUser&id=<?php echo $row['id'] ?>">Delete</a>
                <a class="btn" href="index.php?page_layout=recipe&id=<?php echo $row['id'] ?>">Recipe</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>