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
                             //to check search from url 
                             if(isset($_GET["search"])){
                            // getting search from URL
                              $search = mysqli_real_escape_string ($conn, $_GET["search"]);
                        }                      

                    ?>
                        <h2 class="page-heading"> Search :<?php echo $search;?></h2>
                   <?php  
                        // search title, description , category from the database
                        $getPost ="SELECT post.post_id,post.title,post.description,post.post_date,post.author,
                            category.category_name,user.username,post.category,post.post_img FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE  post.title LIKE '%{$search}%' 
                            OR post.description LIKE '%{$search}%' 
                            OR category.category_name LIKE '%{$search}%' 
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
            <!--- sidebar-->
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>

