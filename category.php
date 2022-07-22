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

                             if(isset($_GET["catid"])){
                             $catId=$_GET["catid"];
                        }
                    $getcategory ="SELECT * FROM category WHERE category_id={$catId}";
                       $catResult= mysqli_query($conn,$getcategory) or die("query faild");
                       $row = mysqli_fetch_assoc($catResult);

                    ?>
                  <h2 class="page-heading"><?php echo $row["category_name"];?></h2>
                   <?php
                        //Calculate Offset Code 
                        $limit =3 ;
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page =1;
                        }
                        $offset = ($page - 1)* $limit;
                        
                        // select query of post table with left join and  with offset and limit
                        $getPost ="SELECT post.post_id,post.title,post.description,post.post_date,post.author,
                            category.category_name,user.username,post.category,post.post_img FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE  post.category = {$catId}
                            ORDER BY post.post_id DESC LIMIT {$offset},{$limit}" ;
                            
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
                                            <?php echo substr( $post['description'],0,120) ."..."?>
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

                        //pagination

                             if(mysqli_num_rows($catResult)>0){
                            $total_records = $row['post'];
                            $total_page = ceil($total_records / $limit);

                            echo "<ul class = 'pagination'>";
                                if($page > 1){
                                    echo '<li> <a href="category.php?catid='. $catId .'&page='.($page - 1).'">prev</a> </li>';
                                }
                                for($i = 1; $i<=$total_page; $i++){
                                    
                                    if( $i == $page){
                                            $active ="active";
                                        }else{
                                            $active="";
                                        }
                                echo '<li class="'.$active.'"><a href="category.php?catid='. $catId .'&page='.$i.'">'.$i.'</a></li>';  
                                }

                                if( $total_page > $page ){
                                    echo '<li> <a href="category.php?catid='. $catId .'&page='.($page + 1).'">next</a> </li>';
                                }
                            echo "</ul>" ;
                        }
                    ?>       
                                  
                </div><!-- /post-container -->
            </div>
               <!--- sidebar-->
           <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
