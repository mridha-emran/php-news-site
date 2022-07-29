<?php include "header.php";
// checking user role to access to the page
    if($_SESSION['userRole']== 0){
           //   to redirect the page 
         header("location: http://localhost/news-site/admin/post.php");
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
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

                    // select query of user table with offset and limit

                     $getUSer ="SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                     $result= mysqli_query($conn,$getUSer) or die("query faild");
                        
                        if(mysqli_num_rows($result)>0){
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                             $serial = $offset + 1;
                        //to read user data from the database through loop
                            while($user = mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $user['first_name']." " .$user['last_name']?></td>
                              <td><?php echo $user['username']?></td>
                              <td><?php 
                                        if($user['role']==1){
                                            echo "Admin";
                                        }else{
                                            echo "Normal User";
                                        }        
                                ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $user["user_id"]?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $user["user_id"]?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php 
                         $serial++;
                        }?>  
                      </tbody>
                  </table>
                  <?php }

                   //pagination
                   $pagin_sql="SELECT * FROM user";
                   $pagin_result= mysqli_query($conn,$pagin_sql) or die("query faild");
                        
                        if(mysqli_num_rows($pagin_result)>0){
                            $total_records = mysqli_num_rows($pagin_result);
                            $total_page = ceil($total_records / $limit);

                            echo "<ul class = 'pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li> <a href="users.php?page='.($page - 1).'">prev</a> </li>';
                                }
                                for($i = 1; $i<=$total_page; $i++){
                                    
                                    if( $i == $page){
                                            $active ="active";
                                        }else{
                                            $active="";
                                        }
                                echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';  
                                }

                                if( $total_page > $page ){
                                    echo '<li> <a href="users.php?page='.($page + 1).'">next</a> </li>';
                                }
                            echo "</ul>" ;
                        }
                  ?>
              </div>
          </div>
      </div>
  </div>

