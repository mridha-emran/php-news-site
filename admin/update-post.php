<?php include "header.php";
    if($_SESSION["userRole"] == 0){
    include "config.php";
     $postId = $_GET['id'];
    $sql = "SELECT author FROM post WHERE post_id = {$postId}";
    $result = mysqli_query($conn, $sql) or die("Query Failed.");

    $row = mysqli_fetch_assoc($result);

    if($row['author'] != $_SESSION["userID"]){
        header("location: http://localhost/news-site/admin/post.php");
    }
    }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
             <?php 
                  // mysql connaction
                    include "config.php";

                    // getting id from URL
                    $postId=$_GET["id"];

                    // get post data from the database
                    $getPost ="SELECT post.post_id, post.title, post.description,post.post_img,
                    category.category_name, post.category FROM post
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id 
                     WHERE post.post_id ={$postId}" ;
                    $postResult= mysqli_query($conn,$getPost) or die("query faild");
                        if(mysqli_num_rows($postResult)>0){

                            //to read user data from the database through loop
                            while($post = mysqli_fetch_assoc($postResult)){
                ?>

        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $post['post_id'];?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $post['title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                    <?php echo $post['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <option disabled> Select Category</option>
                    <?php 
                       // mysql connaction
                       include "config.php";

                       //select query of category table
                        $getCategory ="SELECT * FROM category";
                        $categoryResult= mysqli_query($conn,$getCategory) or die("query faild");
                            if(mysqli_num_rows($categoryResult)>0){
                                while($rows = mysqli_fetch_assoc($categoryResult)){
                                    if($post['category'] == $rows['category_id']){
                                          $selected = "selected";
                                    }else{
                                          $selected="";
                                        }
                                echo"<option{$selected} value='{$rows['category_id']}'>{$rows['category_name']}</option>";
                                };
                            };
                    ?>
                </select>
                  <input type="hidden" name="old_category" value="<?php echo $post['category']; ?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $post['post_img'];?>" height="150px" />
                 <input type="hidden" name="old-image" value="<?php echo $post['post_img'];?>">
                
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
         <?php
                }
                
                    }?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>

