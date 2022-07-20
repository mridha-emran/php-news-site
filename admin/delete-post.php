        <?php 
                  // mysql connaction
                    include "config.php";

                    // getting ids from URL
                    $postId=$_GET["id"];
                    $catId=$_GET["catid"];

                    // get user post data from the database
                    $getPost ="SELECT * FROM post WHERE post_id = {$postId}";
                    $postResult = mysqli_query($conn,$getPost);
                    $row = mysqli_fetch_assoc($postResult);

                    // to delete image from upload folder
                    unlink("upload/".$row['post_img']);
                    
                    // query for delete post data from the database
                     $deletPost ="DELETE FROM post WHERE post_id = {$postId};";
                     $deletPost .="UPDATE category SET post=post-1 WHERE category_id = {$catId};";

                     $result= mysqli_multi_query($conn,$deletPost);
                        //   to direct the page
                        if($result){
                             header("location: http://localhost/news-site/admin/post.php");
                        }else{
                             echo"<p style='color:red;text-align:center; font-size: 20px;'>can't delete this post!</p>";
                        }
                ?>