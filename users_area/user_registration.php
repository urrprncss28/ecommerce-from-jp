<?php include('../includes/connect.php'); 
include('../functions/common_function.php');
include('../includes/responsive.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- bootstrap link -->
    <?php include('../includes/link.php'); ?>
</head>
<body>
<style>
    .logo{
    width: 5%;
    height: 5%;
}
  </style>
    <!---navbar--->
    <div class="container-fluid p-0">
        <!---first child---->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #006400;">
    <div class="container-fluid"><!----edited----->
    <img src="../images/Logo.png" alt="logo" class="logo">
  <button class="navbar-toggler" type="button" data-toggle="collapse"
   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" aria-current="page" href="../index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="../display_all.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="user_login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Contact</a>
      </li>
      
    </ul>
    
  </div>
</nav>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">

                    <!-- username feild -->
                    <div class="form-outline mb-4">
    <label for="user_username" class="form-label">Username</label>
    <input type="text" id="user_username" class="form-control" 
    placeholder="Enter user name" autocomplete="off" required="required"
    name="user_username"/>
                    </div>

                    <!-- email field -->
                    <div class="form-outline mb-4">
    <label for="user_email" class="form-label">Email</label>
    <input type="email" id="user_email" class="form-control" 
    placeholder="Enter your Email" autocomplete="off" required="required"
    name="user_email"/>
                    </div>

                    <!-- image field -->
                    <div class="form-outline mb-4">
    <label for="user_image" class="form-label">Upload profile picture</label>
    <input type="file" id="user_image" class="form-control" 
    required="required" name="user_image"/>
                    </div>

                    <!-- password field -->
                    <div class="form-outline mb-4">
    <label for="user_password" class="form-label">Enter your password</label>
    <input type="password" id="user_password" class="form-control" 
    placeholder="Enter your password" autocomplete="off" required="required"
    name="user_password"/>
                    </div>

                    <!-- confirm password field -->
                    <div class="form-outline mb-4">
    <label for="conf_user_password" class="form-label">Confirm password</label>
    <input type="password" id="conf_user_password" class="form-control" 
    placeholder="Confirm password" autocomplete="off" required="required"
    name="conf_user_password"/>
                    </div>

                    <!-- address feild -->
                    <div class="form-outline mb-4">
    <label for="user_address" class="form-label">Address</label>
    <input type="text" id="user_address" class="form-control" 
    placeholder="Enter your address" autocomplete="off" required="required"
    name="user_address"/>
                    </div>

                     <!-- contact feild -->
                     <div class="form-outline mb-4">
    <label for="user_contact" class="form-label">Contact</label>
    <input type="text" id="user_contact" class="form-control" 
    placeholder="Enter your mobile number" autocomplete="off" required="required"
    name="user_contact"/>
                    </div>

                    <div class="mt-3">
                        <input type="submit" value="Register" class="py-2
                        border-0 px-4" style="border-radius:5px; color: #fff;
                        background-color: #006400;" name="user_register">
                        <p class="small mt-2 pt-1" style="font-weight: bold;">
                        Already have an account? <a href="user_login.php">Login</a></p>
                    </div>

                </form>




            </div>
        </div>
    </div>
</body>
</html>


<!-- php code -->
<?php
if(isset($_POST['user_register'])){
$user_username=$_POST['user_username'];
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
$hash_password=password_hash($user_password,PASSWORD_DEFAULT);
$conf_user_password=$_POST['conf_user_password'];
$user_address=$_POST['user_address'];
$user_contact=$_POST['user_contact'];
$user_image=$_FILES['user_image']['name'];
$user_image_tmp=$_FILES['user_image']['tmp_name'];
$user_ip=getIPAddress();

// select query
// select username
$select_username="select * from user_table where username='$user_username'";
$result_username=mysqli_query($con,$select_username);
$rows_count_username=mysqli_num_rows($result_username);

// select email
$select_email="select * from user_table where user_email='$user_email'";
$result_user_email=mysqli_query($con,$select_email);
$rows_count_email=mysqli_num_rows($result_user_email);

// select contact
$select_contact="select * from user_table where user_mobile='$user_contact'";
$result_user_contact=mysqli_query($con,$select_contact);
$rows_count_contact=mysqli_num_rows($result_user_contact);




if($rows_count_username>0){
  echo "<script>alert('username already exist')</script>";
}else if($rows_count_email>0){
  echo "<script>alert('This email is already used')</script>";
}else if($rows_count_contact>0){
  echo "<script>alert('This number is already used')</script>";
}else if($user_password!=$conf_user_password){
  echo "<script>alert('Password do not match')</script>";
}else{
  // insert query
  move_uploaded_file($user_image_tmp,"./user_images/$user_image");
  $insert_query="insert into user_table (username,user_email,user_password,
  user_image,user_ip,user_address,user_mobile) values ('$user_username',
  '$user_email','$hash_password','$user_image','$user_ip','$user_address',
  '$user_contact')";
  $sql_execute=mysqli_query($con,$insert_query);
  if($sql_execute){
    echo "<script>alert('$user_username Successfully created')</script>";
  }else{
    die(mysqli_error($con));
  }
  }


  // selecting cart items
  $select_cart_items="select * from cart_details where ip_address='$user_ip'";
  $result_cart=mysqli_query($con,$select_cart_items);
  $rows_count=mysqli_num_rows($result_cart);
  if($rows_count>0){
    $_SESSION['username']=$user_username;
    echo "<script>alert('You have items in your cart');</script>";
    echo "<script>alertWindow.open('checkout.php','_self');</script>";
  }else{
    echo "<script>alertWindow.open('../index.php','_self');</script>";
  }

}

?>


<!---last child---->
<div class="p-3 text-center"  style="background-color: #006400;">
  <p style="color: #ffffff;">All rights reserved Design by Group number # - 2024</p>
</div>
    </div>