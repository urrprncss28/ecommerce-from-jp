<?php 
include('../includes/home_button.php');
include('../includes/connect.php'); 
include('../functions/common_function.php');
include('../includes/responsive.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

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
    <h2 class="text-center mb-5">Admin Login</h2>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-xl-5">
            <img src="../images/CAVITE-STATE-U_thumbnail.jpg" alt="admin registration" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="admin_email" class="form-label">Email</label>
                    <input type="admin_email" id="admin_email" name="admin_email" placeholder="Enter your Email" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="admin_password" class="form-label">Password</label>
                    <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                </div>      
                <div>
                    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                    <p class="small fw-bold pt-1 mt-2">Don't you have an account? <a href="admin_registration.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>


<?php

if(isset($_POST['admin_login'])){
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];


    $select_query="select * from admin_table where admin_email='$admin_email'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);


    if($row_count>0){
        $_SESSION['admin_email']=$admin_email;
        if($admin_password==$row_data['admin_password']){
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            
        }else{
            echo "<script>alert('Password is incorrect')</script>";
          }
    }else{
    echo "<script>alert('Invalid credentials')</script>";
  }
}

?>