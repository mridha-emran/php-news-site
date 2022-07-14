  <?php 
     include "config.php";
     // to check image-file upload in input field
     if ( empty($_FILES['new-image']['name'])){
          $file_name =$_POST['old-image'];
        }
        else
        {
                
        //  super global variable use upload file
          $file_name = $_FILES['new-image'] ['name']; 
          $file_size = $_FILES['new-image'] ['size']; 
          $file_tmp = $_FILES['new-image'] ['tmp_name']; 
          $file_type = $_FILES ['new-image'] ['type'] ;

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

        // without any error uplode the file
            if ( empty($errors) == true )
            {
                move_uploaded_file($file_tmp,"upload/".$file_name);
            }
            else
            {
                 print_r( $errors); 
                 die() ;
            }
        }  

        $postUpdate ="UPDATE post SET title='{$_POST["post_title"]}',description ='{$_POST["postdesc"]}',
        category={$_POST["category"]},post_img='{$file_name}'
         WHERE post_id ={$_POST["post_id"]}";
        $result= mysqli_query($conn,$postUpdate);      
        
          if($result){
              //   to direct the page    
                  header("location: http://localhost/news-site/admin/post.php");
              }else{
                 echo "query faild";
              }

     ?>