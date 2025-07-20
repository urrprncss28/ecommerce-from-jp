<!-- connect file -->
<?php
// include('../functions/common_function.php');
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!--bootsrap css link--> <!---edited--->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--font awesome link--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!---css file--->
    <link rel="stylesheet" href="style.css">
    
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
        <a class="nav-link text-light" href="../users_area/user_registration.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Contact</a>
      </li>
    
      
    </ul>
  </div>
</nav>

  <!-- second child -->
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


if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
  <a class='nav-link' href='user_login.php'>Login</a>
  </li>";
}else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='logout.php'>Logout</a>
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

<!---fourth child--->
<div class="row px-3">
  <div class="col-md-12">
    <!--products--->
    <div class="row">
      <?php
  if(!isset($_SESSION['username'])){
    include('user_login.php');
  }else{
    include('payment.php');
  }
  ?>
</div>
<!-- col end -->
</div>
</div>



<div>
  <?php include("../includes/footer.php") ?>
    </div>





<!---bootsrap js link---->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>