<?php include('../includes/connect.php'); 
include('../functions/common_function.php');
include('../includes/responsive.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>

    <!-- bootsrap link -->
    <?php include('../includes/link.php') ?>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Registration</h2>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-xl-5">
            <img src="../images/CAVITE-STATE-U_thumbnail.jpg" alt="admin registration" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your name" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="Confirm_password" class="form-label">Confirm password</label>
                    <input type="password" id="Confirm_password" name="Confirm_password" placeholder="Confirm your password" required="required" class="form-control">
                </div>
                <div>
                    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                    <p class="small fw-bold pt-1 mt-2">have already account? <a href="admin_login.php">login</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>


<?php

if(isset($_POST['admin_registration'])){
    $admin_name=$_POST['username'];
    $admin_email=$_POST['email'];
    $admin_password=$_POST['password'];
    $conf_admin_password=$_POST['Confirm_password'];
    // $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
    // echo $hash_password;


    // select admin name
    $select_username="select * from admin_table where admin_name='$admin_name'";
    $result_email=mysqli_query($con,$select_username);
    $rows_count_name=mysqli_num_rows($result_email);

    // select admin email
    $select_email="select * from admin_table where admin_email='$admin_email'";
    $result_email=mysqli_query($con,$select_email);
    $rows_count_email=mysqli_num_rows($result_email);

    // select admin password
    $select_password="select * from admin_table where admin_password='$admin_password'";
    $result_password=mysqli_query($con,$select_password);
    $rows_count_password=mysqli_num_rows($result_password);


    if($rows_count_email>0){
        echo "<script>alert('Email is already in use!')</script>";
    }else if($admin_password!=$conf_admin_password){
        echo "<script>alert('Password do not matched!')</script>";
    }else{
    // insert query
    $insert_query="insert into admin_table(admin_name,admin_email,admin_password) values ('$admin_name','$admin_email','$admin_password')";
    $sql_execute=mysqli_query($con,$insert_query);
    if($sql_execute){
        echo "<script>alert('$admin_email Successfully Created')</script>";
        echo "<script>window.open('admin_login.php','_self')</script>";
    }else{
        die(mysqli_error($con));
    }
}
}
?>