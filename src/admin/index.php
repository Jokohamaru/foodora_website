<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>
    <style>
        body{
            margin: 0;
            background: #f5f6fa;
            padding: 20px;
             
            
        }
        .nav-list{
            background-color: #39a13eff;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        ul{
            display: flex;
            list-style: none;
            margin: 0;
        }
        li{
            padding: 18px;
             
        }
        a{
            font-size: 18px;
        }
        
        .hello {
            font-size: 18px;
            padding: auto;
            margin: auto;
        }

        .nav-list ul li a {
            display: block;
            padding: 18px 10px;
            color: white;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            transition: all 0.25s ease;
        }
        .nav-list ul li a:hover {
            color: #8fec0eff;
            border-bottom: 3px solid #8fec0eff ;
        }

        header {

        }
        main {
            width: 90%;
            margin: auto;
            
        }
    </style>
</head>
<body>
     <?php
        session_start();
        include('../user/connect.php');
     ?>
    <header>
        <nav class="nav-list">
            <ul>
                 
                <li><a href="index.php?page_layout=user">Người dùng</a></li>
                 
            </ul>
            <ul>
                <li class="hello">Xin chao, <?php echo $_SESSION['username'];?> </li>
                <li><a href="index.php?page_layout=dangxuat">Đăng xuất</a></li>
            </ul>
        </nav>
    </header>
     <main >
        <?php
        if(isset($_GET['page_layout'])){
            switch($_GET['page_layout']){
                case 'dashboard':                       include "dashboard.php";break;

                // Recipe
                case 'recipe':                          include "recipe.php";break;
                case 'addRecipe':                          include "addRecipe.php";break;

                // User
                case 'user':                            include "user.php";break;
                case 'adduser':                         include "adduser.php";break;
                case 'deleteUser':                      include "deleteUser.php";break;
                
                
                case 'dangxuat':
                    session_unset();
                    session_destroy();
                    header('location: ../index.html');
                    break;
            }
        }
    ?>
     </main>
</body>
</html>