<?php include "header.php"; 
     if(isset($_POST["submit"])){

     // mysql connaction
      include "config.php";
        //collecting form input value
        $user_id =mysqli_real_escape_string($conn, $_POST["user_id"]);
        $firstName =mysqli_real_escape_string($conn, $_POST["first_name"]);
        $lastName = mysqli_real_escape_string($conn,$_POST["last_name"]);
        $user =mysqli_real_escape_string($conn,$_POST["user"]);
        $role =mysqli_real_escape_string($conn,$_POST["role"]);

        // update user to data base
        $userUpdate ="UPDATE user SET first_name ='{$firstName}',last_name ='{$lastName}',username='{$user}', role ='{$role}' WHERE user_id ='{$user_id}'";
        $result= mysqli_query($conn,$userUpdate);      
            //   to direct the page      
                if($result){
                    header("location: http://localhost/news-site/admin/users.php");
                }
        }


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php 
                  // mysql connaction
                    include "config.php";
                    // getting id from URL
                    $userId=$_GET["id"];
                    // get user data from the database
                     $getUSer ="SELECT * FROM user WHERE user_id = {$userId}";
                     $result= mysqli_query($conn,$getUSer) or die("query faild");
                        
                        if(mysqli_num_rows($result)>0){
                            //to read user data from the database through loop
                            while($user = mysqli_fetch_assoc($result)){
                ?>


                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $user['user_id']?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?php echo $user['first_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?php echo $user['last_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" value="<?php echo $user['username']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php 
                                        if($user['role']==1){
                                            echo "<option value='0'>normal User</option>
                                                    <option value='1' selected>Admin</option>";
                                        }else{
                                            echo "<option value='0' selected>normal User</option>
                                                    <option value='1'>Admin</option>";
                                        }        
                                ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                  }
                
                    }?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>

