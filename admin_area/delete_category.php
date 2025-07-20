<?php

if(isset($_GET['delete_category'])){
    $delete_category=$_GET['delete_category'];
    // ECHO $delete_category;

    $DELETE_QUERY="DELETE FROM categories where category_id=$delete_category";
    $result=mysqli_query($con,$DELETE_QUERY);
    if($result){
        echo "<script>alert('Category Deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }

}

?>