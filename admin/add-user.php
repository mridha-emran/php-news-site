<?php include "header.php";
    if(isset($_POST["save"])){

     // mysql connaction
      include "config.php";

        //collecting form input value
        $firstName =mysqli_real_escape_string($conn, $_POST["first_name"]);
        $lastName = mysqli_real_escape_string($conn,$_POST["last_name"]);
        $user =mysqli_real_escape_string($conn,$_POST["user"]);
        $password =mysqli_real_escape_string($conn,md5($_POST["password"]));
        $role =mysqli_real_escape_string($conn,$_POST["role"]);

        // verification of user exist
        $userCheck ="SELECT username FROM user WHERE username='{$user}'";
        $result= mysqli_query($conn,$userCheck) or die("query faild");

        if(mysqli_num_rows($result)>0){
            echo"<p style='color:red;text-align:center; font-size: 20px;'>user allready exist</p>";
        }else{
            // new user adding
            $addUser="INSERT INTO user(first_name, last_name, username, password, role) 
                      VALUES  ('{$firstName}','{$lastName}','{$user}','{$password}','{$role}')";
            $userResult= mysqli_query($conn,$addUser);
           
            //   to direct the page      
                if($userResult){
                    header("location: http://localhost/news-site/admin/users.php")
                }
        }
    }
    
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
