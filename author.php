<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                     // mysql connaction
                        include "config.php";

                             if(isset($_GET["authid"])){
                            // getting authid from URL
                              $authid=$_GET["authid"];
                        }
                        
                      $getAuth ="SELECT * FROM post JOIN user ON post.author = user.user_id 
                                WHERE post.author = {$authid}";
                       $authResult= mysqli_query($conn,$getAuth) or die("query faild");
                       $row = mysqli_fetch_assoc($authResult);

                    ?>
                        <h2 class="page-heading"><?php echo $row["username"];?></h2>
                   <?php  
                        // get post data from the database
                        $getPost ="SELECT post.post_id,post.title,post.description,post.post_date,post.author,
                            category.category_name,user.username,post.category,post.post_img FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE  post.author = {$authid}
                            ORDER BY post.post_id DESC" ;
                            
                        $result= mysqli_query($conn,$getPost) or die("query faild");
                            
                            if(mysqli_num_rows($result)>0){
                                while($post = mysqli_fetch_assoc($result)){
                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $post["post_id"]?>"><img src="admin/upload/<?php echo $post['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $post["post_id"]?>'><?php echo $post['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?catid=<?php echo $post['category'];?>'><?php echo $post['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                               <a href='author.php?authid=<?php echo $post['author'];?>'><?php echo $post['username']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $post['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo $post['description']?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $post["post_id"]?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php }
                        }else{
                            echo"no record found";
                        }
                    ?>      
                </div><!-- /post-container -->
            </div>
        </div>
      </div>
    </div>
