<?php
include('../includes/connect.php');
include('../functions/common_function.php');
include('../includes/responsive.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin  Dashbaord</title>
    <?php include('../includes/link.php') ?>

    <style>
        .admin_image{
            width: 100px;
            object-fit: contain;
        }
        .product_img{
            width:100px;
            object-fit:contain;
        }
        td, th {
            text-align: center;
        vertical-align: middle;
    }

    </style>

</head>
<body>
    <!---navbar--->
    <div class="container-fluid p-0">
        <!---first child---->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #006400;">
            <div class="container-fluid">
                <img src="../images/Logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome Guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!---second child---->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>


        <!---third child--->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/profile.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <!---button*10>a.nav-link.text-light.bg-info.my-1---->
                <div class="button text-center">
                    <button class=""><a href="insert_product.php" class="nav-link text-light my-1" style="background-color: #006400;">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light my-1" style="background-color: #006400;">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light my-1" style="background-color: #006400;">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light my-1" style="background-color: #006400;">View Categories</a></button>
                    <button><a href="index.php?insert_brands" class="nav-link text-light my-1" style="background-color: #006400;">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light my-1" style="background-color: #006400;">View Brands</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light my-1" style="background-color: #006400;">All orders</a></button>
                    <button><a href="index.php?list_payment" class="nav-link text-light my-1" style="background-color: #006400;">All payment</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light my-1" style="background-color: #006400;">List users</a></button>
                    <button><a href="" class="nav-link text-light my-1" style="background-color: #006400;">Logout</a></button>
                </div>
        </div>
    </div>

        <!---fourth child---->
        <div class="container my-3">
            <?php
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brands'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_brands'])){
                include('edit_brands.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_brands'])){
                include('delete_brands.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['list_payment'])){
                include('list_payment.php');
            }
            if(isset($_GET['list_users'])){
                include('list_users.php');
            }
            if(isset($_GET['admin_logout'])){
                include('admin_logout.php');
            }
            ?>
        </div>
        <!-- last child -->
        
        <?php include("../includes/footer.php") ?>
    </div>


<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>