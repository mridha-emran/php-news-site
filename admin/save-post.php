     <?php 
        // mysql connaction
            include "config.php";

            // to check file upload in input field
         if(isset($_FILES['fileToUpload'])){
            $errors = array();
         
        //  super global variable use upload file
          $file_name = $_FILES['fileToUpload'] ['name']; 
          $file_size = $_FILES['fileToUpload'] ['size']; 
          $file_tmp = $_FILES['fileToUpload'] ['tmp_name']; 
          $file_type = $_FILES ['fileToUpload'] ['type'] ;

        // to extract the last name of the file
          $tmp = explode('.', $file_name);
          $file_ext = end($tmp);

        //file extension
          $extensions = array("jpeg" , "jpg" , "png") ; 

        // to check file extension
           if (in_array( $file_ext , $extensions) === false ) 
            {
                $errors[]="This extension file not allowed , Please choose a JPG or PNG fill";
            }; 

        // to check file size
           if ( $file_size > 2097152 ) 
            {
                $errors[] = " File size must be 2mb or lower . " ;
            }; 

        //  time add with image name
             $new_name = time(). "-".basename($file_name);
             $target = "upload/".$new_name;

        // without any error uplode the file
            if ( empty($errors) == true )
            {
                move_uploaded_file($file_tmp,$target);
            }
            else
            {
                 print_r( $errors); 
                 die() ;
            }
        }
           
        session_start();
        // get input fieid values from add-post.php form
        $title = mysqli_real_escape_string ($conn , $_POST['post_title']) ; 
        $description = mysqli_real_escape_string ($conn , $_POST['postdesc'] ) ;  
        $category = mysqli_real_escape_string ($conn , $_POST['category'] ) ;
        
        // to save sarver date into data
        $date = date( " d ,M , Y " ) ; 

        // get session values from index.php
        $author =  $_SESSION['userID'];

        //insert query to add post in post table
        $addPost = "INSERT INTO post (title, description, category, post_date, author, post_img) 
                    VALUES ('{$title}','{$description}',{$category},'{$date}',{$author},'{$new_name}');";
        //concat query to update category
        $addPost .="UPDATE category set post =post+1 WHERE category_id ={$category}";
        
        // multi_query used to run two command
        if(mysqli_multi_query($conn, $addPost)){
        //   to direct the page   
         header("location:http://localhost/news-site/admin/post.php");
        }else{
            echo"query faild";
        }
                        
     ?>