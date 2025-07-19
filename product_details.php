<!-- connect file -->
<?php

include('includes/connect.php');
include('functions/common_function.php');
include('includes/responsive.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopee</title>
    <?php include('./includes/link_user.php') ?>
    <style>
body{
  overflow-x:hidden;
}
</style>
</head>
<body>
    <!---navbar--->
    <div class="container-fluid p-0">
        <!---first child---->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #006400;"><!---d napipindot ung menu pag nag responsive-->
    <div class="container-fluid"><!----edited----->
    <img src="./images/Logo.png" alt="logo" class="logo">
  <button class="navbar-toggler" type="button" data-toggle="collapse"
   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="display_all.php">Products</a>
      </li>
      <?php
      if(isset($_SESSION['username'])){
       echo "<li class='nav-item'>
        <a class='nav-link text-light' href='users_area/profile.php'>My Account</a>
      </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link text-light' href='users_area/user_registration.php'>Register</a>
      </li>";
      }
      ?> 
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
        <?php cart_item();?>
        </sup></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Total Price: <?php total_cart_price(); ?></a>
      </li>
    </ul>
    <form class="d-flex" action="search_product.php" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
      <input type="submit" value="search" class="btn btn-outline-light"
      name="search_data_product">
    </form>
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


if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
  <a href='./users_area/user_login.php'><button type='button' class='btn btn-info' >Login</button></a>
  </li>";
}else{
  echo "<li class='nav-item'>
  <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#exampleModalCenter'>Logout</button>
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
  <div class="col-md-10">
    <!--products--->
    <div class="row">


      <!--  fetching products -->
      
    <?php
    // calling function
    view_details();
    get_unique_categories();
    get_unique_brands();
    ?>
    
      <!-- row end -->
  </div>
    <!-- col end -->


</div>




  <div class="col-md-2 bg-secondary p-0">
    <!--side nav-->
    <!---brands to be diplayed-->
    <ul class="navbar-nav me-auto text-center">
      <li class="nav-item"  style="background-color: #006400;">
        <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
      </li>
      <?php
        getbrands()
      ?>
    </ul>



    <!---category to be diplayed-->
    <ul class="navbar-nav me-auto text-center">
      <li class="nav-item"  style="background-color: #006400;">
        <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
      </li>
      <?php
        getcategories();
      ?>
    </ul>
    
  </div>
</div>



<!---last child---->
<!-- include footer -->
<?php include("./includes/footer.php") ?>
    </div>




<!---bootsrap js link---->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
        <button type="button" class="btn btn-danger" onclick="location.href='./users_area/logout.php';">Logout</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>