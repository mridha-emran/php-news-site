<?php
    include 'config.php';
    if($_SESSION["userRole"] == '0'){
      header("Location:http://localhost/news-site/admin/post.php");
    }
    $cat_id = $_GET["id"];

    /*sql to delete a record*/
    $sql = "DELETE FROM category WHERE category_id ='{$cat_id}'";

    if (mysqli_query($conn, $sql)) {
        header("location: http://localhost/news-site/admin/category.php");
    }

    mysqli_close($conn);

?>
