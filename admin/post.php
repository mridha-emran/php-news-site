<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
              <?php 
                  // mysql connaction
                    include "config.php";

                    //Calculate Offset Code 
                     $limit =3 ;
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page =1;
                        }
                        $offset = ($page - 1)* $limit;

                    if($_SESSION['userRole'] =='1'){
                       // select query of post table for admin user 
                     $getPost ="SELECT post.post_id,post.title,post.description,post.post_date,
                     category.category_name,user.username,post.category FROM post
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}" ;
                    }
                    // select query of post table for normal user 
                    elseif ($_SESSION['userRole']=='0') {
                     $getPost ="SELECT post.post_id,post.title,post.description,post.post_date,
                     category.category_name,user.username,post.category FROM post
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id 
                     WHERE post.author ={$_SESSION['userID']}
                     ORDER BY post.post_id DESC LIMIT {$offset},{$limit}" ;
                     
                    } 
                     $result= mysqli_query($conn,$getPost) or die("query faild");
                        
                        if(mysqli_num_rows($result)>0){
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        //to read post data from the database through loop
                            while($post = mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                            <td class='id'><?php echo $post['post_id']?></td>
                              <td><?php echo $post['title']?></td>
                              <td><?php echo $post['category_name']?></td>
                              <td><?php echo $post['post_date']?></td>
                              <td><?php echo $post['username']?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $post["post_id"]?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $post["post_id"]?>&catid=<?php echo $post["category"]?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php }?>  
                          
                      </tbody>
                  </table>
                  <?php }

                   //pagination
                   $pagin_sql="SELECT * FROM post";
                   $pagin_result= mysqli_query($conn,$pagin_sql) or die("query faild");
                        
                        if(mysqli_num_rows($pagin_result)>0){
                            $total_records = mysqli_num_rows($pagin_result);
                            $total_page = ceil($total_records / $limit);

                            echo "<ul class = 'pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li> <a href="post.php?page='.($page - 1).'">prev</a> </li>';
                                }
                                for($i = 1; $i<=$total_page; $i++){
                                    
                                    if( $i == $page){
                                            $active ="active";
                                        }else{
                                            $active="";
                                        }
                                echo '<li class="'.$active.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';  
                                }

                                if( $total_page > $page ){
                                    echo '<li> <a href="post.php?page='.($page + 1).'">next</a> </li>';
                                }
                            echo "</ul>" ;
                        }
                  ?>
              </div>
          </div>
      </div>
  </div>

