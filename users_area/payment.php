<?php 
include('../includes/home_button.php');
include('../includes/connect.php'); 
include('../functions/common_function.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment method</title>
    <!--bootsrap css link--> <!---edited--->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
  crossorigin="anonymous">
</head>
<style>
    img{
        width: 50%;
        margin: auto;
        display: block;
    }
    .row {
    display: flex;
    justify-content: center;
    align-items: center;
}
.col-md-6 .COD {
    text-decoration: none;
}
</style>
<body>
    <!-- php code to access user id -->
    <?php
    $user_ip=getIPAddress();
    $get_user="select * from user_table where user_ip='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['user_id'];


    ?>
    <div class="container">
        <h2 class="text-center" style="color: #006400;">Payment options</h2>
        <div class="row my-5">
            <div class="col-md-6">
            <a href="https://www.Gcash.com" target="_blank">
                <img src="../images/GCash-Logo.png" alt=""></a>
            </div>
            <div class="col-md-6">
            
            <a class="COD" href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">
                Cash on Delivery</h2></a>
            </div>          
        </div>
    </div>
</body>
</html>