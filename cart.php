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
    <title>cart details</title>
    <?php include('./includes/link_user.php') ?>
    <style>
      .cart_img{
    width: 100px;
    height: 100px;
    object-fit: contain;
    }
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
      <li class="nav-item">
        <a class="nav-link text-light" href="users_area/user_registration.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
          <?php cart_item();?></sup></a>
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
  <a class='nav-link' href='./users_area/profile.php'>Welcome ".$_SESSION['username']."</a>
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

<!-- fourth child table -->

<div class="container">
  <div class="row justify-content-center">
  <form action="" method="post">
    <table class="table table-bordered text-center">
      


<!-- php code to display dynamic data -->
<?php


// Handle removal of cart items
function remove_cart_item(){
  global $con;
  if(isset($_POST['remove_cart'])) {
      $remove_id = $_POST['remove_cart'];
      $get_ip_add = getIPAddress(); // Assuming this function retrieves the current user's IP address
      $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id AND ip_address='$get_ip_add'";
      $run_delete = mysqli_query($con, $delete_query);
      if($run_delete) {
          echo "<script>window.open('cart.php','_self')</script>";
      }
  }
}

remove_cart_item(); // Call the function to check for removal at the start
              
              $get_ip_add = getIPAddress();
          // edited > file: extra
          if(isset($_POST['update_cart'])){
            foreach($_POST['qty'] as $product_id => $quantity){
                if($quantity > 0){ // Ensure the quantity is a positive number
                    $update_cart = "Update cart_details set quantity='$quantity' WHERE product_id='$product_id' AND ip_address='$get_ip_add'";
                    $run_update = mysqli_query($con, $update_cart);
                    
                }
            }
            
            echo "<script>window.open('cart.php','_self')</script>";
        }
        // until here

             $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
$result = mysqli_query($con, $cart_query);
$result_count = mysqli_num_rows($result);

// Display the cart items
if($result_count > 0) {
    echo "<form method='post'>";
    echo "<thead>
    <tr class='bg-info text-light'>
      <th>Product Name</th>
      <th>Product Image</th>
      <th>Quantity</th>
      <th>Total Price</th>
      <th>Operations</th>
      <th colspan='2'>Remove</th>
    </tr>
  </thead>
  <tbody>";
    
    $total_price = 0;
    while($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        if($row_product = mysqli_fetch_array($result_products)) {
            $price = $row_product['product_price'];
            $product_title = $row_product['product_title'];
            $product_image1 = $row_product['product_image1'];
            $line_total = $price * $quantity;
            $total_price += $line_total;

            echo "<tr>
                    <td>{$product_title}</td>
                    <td><img class='cart_img' src='./admin_area/product_images/{$product_image1}' alt=''></td>
                    <td><input style='border-radius: 5px;' type='number' class='form-input w-50 text-center' name='qty[{$product_id}]' value='{$quantity}'></td>
                    <td>{$line_total}</td>
                    <td colspan='2'><button class='bg-secondary border-0' style='border-radius:5px; padding:10px; color:#fff;' type='submit' name='update_cart'>Update Cart</button></td>
                    <td><button class='bg-danger border-0' style='border-radius:5px; padding:10px;color:#fff;' type='submit' name='remove_cart' value='{$product_id}'>Remove</button></td></tr>";
                    
        }
    }
   
    echo "</tbody></table></form>";
} else {
    echo "<h3>Your cart is empty!</h3>";
}
?>
      </tbody>
    </table>
    <!-- Subtotal -->
  <div class="d-flex mb-3">
    <?php 
    $get_ip_add = getIPAddress();
    $cart_query="Select * from cart_details where ip_address='$get_ip_add'";
    $result=mysqli_query($con,$cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
      echo "<h4 class='px-3'>Total: <strong style='color: #006400;'>$total_price ₱</strong></h4>
      <a href='index.php' class='mx-3 text-light bg-success border-0' style='display: inline-block; text-decoration: none; color: #fff; border-radius: 5px; padding:30px;'>Continue Shopping</a>

            

<a href='./users_area/checkout.php' class='mx-3 text-light bg-info border-0' style='display: inline-block; text-decoration: none; color: #fff; border-radius: 5px; padding:30px;'>Check out</a>";

    }else{
      
      echo "<input style='background-color: #006400; border-radius: 5px; color: #fff;' type='submit' 
            value='Continue Shopping' class='p-2 border-0' name='continue_shopping'>";
    }

if(isset($_POST['continue_shopping'])){
  echo "<script>window.open('index.php','_self')</script>";
}


    ?>



    </div>
  </div>

</div>
</form>
<!-- function to remove item -->


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