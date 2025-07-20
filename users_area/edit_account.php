<?php
if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="select * from user_table where username='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $username=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}

if(isset($_POST['user_update'])){
    $update_id=$user_id;
    // $user_id=$_POST['user_id'];
    $username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_address=$_POST['user_address'];
    $user_mobile=$_POST['user_mobile'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");


    // update query
    $update_data="update user_table set username='$username',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' where user_id=$update_id";
    $result_query_update=mysqli_query($con,$update_data);
    if($result_query_update){
        echo "<script>alert('data updated successfully')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="m-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="">Username</h5>
            <input type="text" placeholder="Enter your new username" class="form-control w-50 ml-2" value="<?php echo $username ?>" name="user_username" style="border-radius:10px;">
            </div>
        </div>

        <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="">Email</h5>
            <input type="email" placeholder="Enter your new Email" class="form-control w-50 ml-5" value="<?php echo $user_email ?>" name="user_email" style="border-radius:10px;">
        </div>
        </div>

        <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="mr-2">Profile picture</h5>
            <input type="file" class="form-control w-50" style="margin-right:40px;" name="user_image" style="border-radius:10px;" required="required">
        </div>
        </div>

        <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="mr-4">Address</h5>
            <input type="text" class="form-control w-50 ml-1" placeholder="Enter your new Address" value="<?php echo $user_address ?>" name="user_address" style="border-radius:10px;">
        </div>
        </div>

        <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="mr-3">Contact</h5>
            <input type="text" class="form-control w-50 ml-3" placeholder="Enter your new Contact number" value="<?php echo $user_mobile ?>"name="user_mobile" style="border-radius:10px;">
        </div>
        </div>

        <!-- <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="mr-3 ">Password</h5>
            <input type="text" class="form-control w-50 " placeholder="Enter your new Password" name="user_mobile" style="border-radius:10px;">
        </div>
        </div>

        <div class="form-outline mb-4">
        <div class="d-flex justify-content-center align-items-center "><h5 class="mr-2" style="margin-left:-20px;">Confirm password</h5>
            <input type="text" class="form-control w-50 mr-5" placeholder="Confirm password" name="user_mobile" style="border-radius:10px;">
        </div>
        </div> -->

        <input class="bg-info text-light mt-3 mb-3 py-2 px-3 border-0" type="submit" value="update"  name="user_update" style="border-radius: 5px;">
    </form>
</body>
</html>