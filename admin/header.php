<?php 

    session_start();
        // session info from index page

    if(!isset($_SESSION["username"])){
         //   to direct the page   
         header("location:http://localhost/news-site/admin/");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
         <link rel="stylesheet" href="../css/font-awesome.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
      <!-- HEADER -->
        <div id="header-admin">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-9  col-md-3">
                        <a href="logout.php" class="admin-logout" >Hello <?php echo $_SESSION['username'] ;?>, logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li>
                                <a href="post.php">Post</a>
                            </li>
                            <?php 
                            if($_SESSION['userRole']==1){
        
                                ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>    
</html>