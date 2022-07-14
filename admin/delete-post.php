        <?php 
                  // mysql connaction
                    include "config.php";

                    // getting id from URL
                       $postId=$_GET["id"];
                       $catId=$_GET["catid"];
                    // query for delete post data from the database
                     $getUSer ="DELETE FROM post WHERE post_id = {$postId};";
                     $getUSer .="UPDATE category SET post=post-1 WHERE category_id = {$catId};";

                     $result= mysqli_multi_query($conn,$getUSer);
                        //   to direct the page
                        if($result){
                             header("location: http://localhost/news-site/admin/post.php");
                        }else{
                             echo"<p style='color:red;text-align:center; font-size: 20px;'>can't delete this post!</p>";
                        }
                ?>