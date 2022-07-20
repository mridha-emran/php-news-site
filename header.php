<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>News-site</title>
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
