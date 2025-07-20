<?php
include('../includes/connect.php');
include('../includes/responsive.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    // echo $order_id;
    $select="select * from user_orders where order_id=$order_id";
    $result=mysqli_query($con,$select);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];
}
if(isset($_POST['confirm_payment'])){
  $invoice_number=$_POST['invoice_number'];
  $amount=$_POST['amount'];
  $payment_mode=$_POST['payment_mode'];
  $insert_query="insert into user_payments (order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
  $result=mysqli_query($con,$insert_query);
  if($result){
    // echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
    echo "<script>window.open('profile.php?my_orders','_self')</script>";
  }
  $update_orders="update user_orders set order_status='Complete' where order_id=$order_id";
  $result_orders=mysqli_query($con,$update_orders);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- bootsrap css link 2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <!---css file--->
<link rel="stylesheet" href="../style.css">

<style>
body{
  overflow-x:hidden;
}

      </style>
</head>
<body class="">
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
      
    </ul>
    <form class="d-flex" action="search_product.php" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
      <input type="submit" value="search" class="btn btn-outline-light"
      name="search_data_product">
    </form>
  </div>
</nav>
<!-- calling cart function -->

<!--second child--->


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
?>

</ul>
</nav>

<!--third child--->
<div class="bg-light">
  <h3 class="text-center">Hidden Store</h3>
  <p class="text-center">*Sentence here*</p><!----sentence here---->
</div>
<div class="contaier mx-5" >
    <a href="profile.php?my_orders"><button class="px-4 py-2" style="border-radius:5px; border:none; background-color: #006400; color:#fff;">Back</button></a>
</div>
    <div class="container my-4">
    <h1 class="text-center" >Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
            <label for="" class="">Order number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment mode</option>
                    <option>Gcash</option>
                    <option>Credit Card</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-success text-light py-2 px-2 border-0" value="confirm" name="confirm_payment" style="border-radius:5px;">
            </div>
            <div class="g-recaptcha" data-sitekey="6LeCZrMpAAAAAN2AqcgtPrbAdR9EUU38UZi5FwPd">

            </div>
        </form>
    </div>
    
</body>
</html>