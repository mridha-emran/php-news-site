<?php
    include "config.php";
    // to get the name and path of the current file
    $page = basename($_SERVER['PHP_SELF']);

    //to check different page titles
    switch ($page) {

        // single page title
        case 'single.php':
                if(isset($_GET["id"])){
                   $sql_title ="SELECT * FROM post WHERE post_id= {$_GET["id"]}";
                    $sql_result= mysqli_query($conn,$sql_title) or die("query faild:title");
                    $title_row = mysqli_fetch_assoc($sql_result);
                    $page_title = $title_row['title'];
                }else{
                    $page_title = "no title found";
                }
            break;

        // search result title
        case 'search.php':
                 if(isset($_GET["search"])){
                
                    $page_title = $_GET["search"];
                }else{
                    $page_title = "no search result found";
                }
            break;

        // category title
        case 'category.php':
                if(isset($_GET["catid"])){
                   $sql_title ="SELECT * FROM category WHERE category_id= {$_GET["catid"]}";
                    $sql_result= mysqli_query($conn,$sql_title) or die("query faild:title");
                    $title_row = mysqli_fetch_assoc($sql_result);
                    $page_title = $title_row['category_name'];
                }else{
                    $page_title = "no title found";
                }
            break;

        // author title
        case 'author.php':
                 if(isset($_GET["authid"])){
                   $sql_title ="SELECT * FROM user WHERE user_id= {$_GET["authid"]}";
                    $sql_result= mysqli_query($conn,$sql_title) or die("query faild:title");
                    $title_row = mysqli_fetch_assoc($sql_result);
                    $page_title = $title_row['username'];
                }else{
                    $page_title = "no title found";
                }
            break;
        default:
            $page_title ="News-site";
            break;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> <?php echo $page_title?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/logo-01.png"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <?php 
                        // mysql connaction
                        include "config.php";

                        // getting ids from URL
                             if(isset($_GET["catid"])){
                             $catId=$_GET["catid"];
                        }
                        // get category data from the database
                        $getcategory ="SELECT * FROM category WHERE post > 0" ;
                            
                        $result= mysqli_query($conn,$getcategory) or die("query faild : category");
                            
                            if(mysqli_num_rows($result)>0){
                                 $active=""
                    ?>
                <ul class='menu'>
                    <li> <a href='http://localhost/news-site/'> Home</a></li>
                     <?php
                        //to read  data from the database through loop
                            while($row = mysqli_fetch_assoc($result)){
                                 if(isset($_GET["catid"])){
                                    if( $row['category_id'] == $catId){
                                        $active ="active";
                                    }else{
                                        $active="";
                                    }
                        }
                                echo"<li><a class='{$active}' href='category.php?catid={$row['category_id']}'>{$row['category_name']}</a></li>";
                            }
                        ?>
                   
                   
                </ul>
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
