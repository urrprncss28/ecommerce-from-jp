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
    <title>Login</title>
    <!--bootsrap css link--> <!---edited--->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
  crossorigin="anonymous">
</head>
<body>
    
    <div class="container-fluid my-5">
        <h2 class="text-center">Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">

                    <!-- username feild -->
                    <div class="form-outline mb-4">
    <label for="user_username" class="form-label">Username</label>
    <input type="text" id="user_username" class="form-control" 
    placeholder="Enter username" autocomplete="off" required="required"
    name="user_username"/>
                    </div>

                    <!-- password field -->
                    <div class="form-outline mb-4">
    <label for="user_password" class="form-label">Enter your password</label>
    <input type="password" id="user_password" class="form-control" 
    placeholder="Enter your password" autocomplete="off" required="required"
    name="user_password"/>
                    </div>


                    <div class="mt-3">
                        <input type="submit" value="Login" class="py-2
                        border-0 px-4" style="border-radius:5px; color: #fff;
                        background-color: #006400;" name="user_login">
                        <p class="small mt-2 pt-1" style="font-weight: bold;">
                        Don't have an account? <a href="user_registration.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
$user_username=$_POST['user_username'];
$user_password=$_POST['user_password'];

$select_query="select * from user_table where username='$user_username'";
$result=mysqli_query($con,$select_query);
$row_count=mysqli_num_rows($result);
$row_data=mysqli_fetch_assoc($result);
$user_ip=getIPAddress();


// cart item
$select_query_cart="select * from cart_details where ip_address='$user_ip'";
$select_cart=mysqli_query($con,$select_query_cart);
$row_count_cart=mysqli_num_rows($select_cart);

if($row_count>0){
  $_SESSION['username']=$user_username;
  if(password_verify($user_password,$row_data['user_password'])){
    // echo "<script>alert('Login Successful')</script>";
    if($row_count==1 and $row_count_cart==0){
      $_SESSION['username']=$user_username;
      echo "<script>alert('Login Successful')</script>";
      echo "<script>window.open('profile.php','_self')</script>";
    }else{
      $_SESSION['username']=$user_username;
      echo "<script>alert('Login Successful')</script>";
      echo "<script>window.open('payment.php','_self')</script>";
    }

  }else{
    echo "<script>alert('Username or Password is incorrect')</script>";
  }
}else{
  echo "<script>alert('Username or Password is incorrect')</script>";
}



}
?>


    </div>