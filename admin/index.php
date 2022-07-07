
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
         <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/style.css">
    </head>

     <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                             <!-- /Form  End -->

                        <?php
                         if(isset($_POST["login"])){
                            // mysql connaction
                            include "config.php";

                            //collecting form input value                           
                            $user =mysqli_real_escape_string($conn,$_POST["username"]);
                            $password =mysqli_real_escape_string($conn,md5($_POST["password"]));

                            // verification of user info
                            $userCheck ="SELECT user_id, username ,role FROM user WHERE username='{$user}' AND password ='{$password}'";
                            $result= mysqli_query($conn,$userCheck) or die("query faild");

                            if(mysqli_num_rows($result) > 0){
                                while( $row = mysqli_fetch_assoc($result)){

                                    // creating a session 
                                    session_start();
                                   $_SESSION['username'] = $row["username"];
                                    $_SESSION['userID'] = $row["user_id"];
                                    $_SESSION['userRole'] = $row["role"];
                                    
                                    //   to direct the page   
                                    header("location: http://localhost/news-site/admin/users.php");
                                }
                            }else{
                                
                                echo "login faild";
                            }
                        }
                        
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
