        <?php 
                  // mysql connaction
                    include "config.php";

                    // getting id from URL
                       $userId=$_GET["id"];
                    // get user data from the database
                     $getUSer ="DELETE FROM user WHERE user_id = {$userId}";
                     $result= mysqli_query($conn,$getUSer);
                        //   to direct the page
                        if($result){
                             header("location: http://localhost/news-site/admin/users.php");
                        }else{
                             echo"<p style='color:red;text-align:center; font-size: 20px;'>can't delete the user!</p>";
                        }
                ?>