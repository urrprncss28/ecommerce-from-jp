<?php

if(isset($_GET['delete_brands'])){
    $delete_brands=$_GET['delete_brands'];
    // ECHO $delete_category;

    $DELETE_QUERY="DELETE FROM brands where brand_id=$delete_brands";
    $result=mysqli_query($con,$DELETE_QUERY);
    if($result){
        echo "<script>alert('brands Deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }

}

?>