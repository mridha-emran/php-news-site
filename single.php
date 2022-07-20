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
                            // getting id from URL
                            $postId=$_GET["id"];
                        // get post data from the database
                        $getPost ="SELECT post.post_id,post.title,post.description,post.post_date,
                            category.category_name,user.username,post.category,post.post_img FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id WHERE post.post_id ={$postId}";
                            
                        $result= mysqli_query($conn,$getPost) or die("query faild");
                            
                            if(mysqli_num_rows($result)>0){
                                while($post = mysqli_fetch_assoc($result)){
                    ?>
                      
                        <div class="post-content single-post">
                            <h3><?php echo $post['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    
                                    <a href='category.php?catid=<?php echo $post['category'];?>'><?php echo $post['category_name']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo $post['username']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                 <?php echo $post['post_date']?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $post['post_img']?>" alt=""/>
                            <p class="description">
                                <?php echo $post['description']?>
                            </p>
                        </div>
                    <?php }
                        }else{
                            echo"no record found";
                        }
                    ?>
                    </div>
                    <!-- /post-container -->
                </div>
            </div>
        </div>
    </div>
