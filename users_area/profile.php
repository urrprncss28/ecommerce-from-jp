<?php
include('../includes/connect.php');
include('../functions/common_function.php');
include('../includes/responsive.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username'] ?> Profile</title>
    <?php include('../includes/link.php') ?>
</head>
<body>
    <style>
        .logo{
    width: 5%;
    height: 5%;
}
body{
  overflow-x:hidden;
}
.profile_img{
  width: 180px;
}
    </style>
 <!---navbar--->
 <div class="container-fluid p-0">
        <!---first child---->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #006400;"><!---d napipindot ung menu pag nag responsive-->
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
      <!-- <li class="nav-item">
        <a class="nav-link text-light" href="users_area/user_registration.php">Register</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
          <?php cart_item();?></sup></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="../cart.php">Total Price: <?php total_cart_price(); ?></a>
      </li>
    </ul>
  </div>
</nav>
<!-- calling cart function -->
<?php
cart();
?>

<!--second child--->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">

<?php
if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome Guest</a>
      </li>";
}else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
  </li>";
}




?>

</ul>
</nav>

<!--third child--->
<div class="bg-light">
  <h3 class="text-center">Hidden Store</h3>
  <p class="text-center">*Sentence here*</p><!----sentence here---->
</div>

<div class="row m-4">
    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height:100vh; border-radius:15px; border:solid black 1px;">
                    <h4 class="nav-item bg-info text-light p-2" style="border-radius:15px;">
                    <?php
if(isset($_SESSION['username'])){
  echo "".$_SESSION['username']."";
}
?></h4>  
            
                <?php
$user_name=$_SESSION['username'];
$user_image="select * from user_table where username='$user_name'";
$result_image=mysqli_query($con,$user_image);
$row_image=mysqli_fetch_array($result_image);
$user_image=$row_image['user_image'];
echo "<li class='nav-item'>
<img src='./user_images/$user_image' class='profile_img my-4' alt=''>
</li>";
                ?>
            <li class="nav-item">
                <a href="profile.php" class="nav-link text-light">Pending orders</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?edit_account" class="nav-link text-light">Account</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?my_orders" class="nav-link text-light">My orders</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
            </li>
            <li class="nav-item">
            <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#exampleModalCenter'>Logout</button>
            </li>
            
        </ul>
    </div>
    <div class="col-md-10 text-center">
      <?php
      get_user_order_details();
      if(isset($_GET['edit_account'])){
        include('edit_account.php');
      }
      if(isset($_GET['my_orders'])){
        include('user_orders.php');
      }
      if(isset($_GET['delete_account'])){
        include('delete_account.php');
      }
      ?>
    </div>
</div>




<?php include("../includes/footer.php") ?>
    </div>

<!-- Logout Confirmation Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"> 
      <div class="modal-body">
        <h5 class="text-center">Are you sure you want to logout?</h5>
      </div>
      <div class="modal-footer">
        <!-- Use buttons for actions and handle actions via JavaScript or proper linking -->
        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        <!-- Correct logout button -->
        <button type="button" class="btn btn-danger" onclick="location.href='logout.php';">Logout</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>