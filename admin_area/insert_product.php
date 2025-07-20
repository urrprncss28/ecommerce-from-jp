<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])){

    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keyword=$_POST['product_keyword'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    // accessing images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];
    
    // accessing image tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];




    // checking empty condition
    if($product_title=='' or $description=='' or $product_keyword=='' or
    $product_category=='' or $product_brands=='' or $product_price=='' or
    $product_image1=='' or $product_image2=='' or $product_image3==''){

        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");


        // insert query
        $insert_product="insert into products (product_title, product_description,
        product_keywords, category_id, brand_id, product_image1, product_image2,
        product_image3, product_price, date, status) values ('$product_title', 
        '$description', '$product_keyword', '$product_category', '$product_brands',
        '$product_image1', '$product_image2', '$product_image3', '$product_price',
        NOW(), '$product_status')";
        $result_query=mysqli_query($con,$insert_product);
        if($result_query){
            echo "<script>alert('Successfully inserted Products')</script>";
        }



    }



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!--bootstrap css link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!---font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    
    
    <!--css file link---->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
    <div class="contaier" >
    <a href="index.php"><button class="px-4 py-2" style="border-radius:5px; border:none; background-color: #006400; color:#fff;">Back</button></a>
</div>
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto ">
                <label for="product_title" class="form-label mt-3">Product Name</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                 placeholder="Enter product Name" autocomplete="off" required="required">
            </div>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label mt-3">Product Description</label>
                <input type="text" name="description" id="description" class="form-control"
                 placeholder="Enter product Description" autocomplete="off" required="required">
            </div>

            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label mt-3">Product keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                 placeholder="Enter product keyword" autocomplete="off" required="required">
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-control mt-3">
                    <option value="">Select Category</option>

                    <?php
                    $select_query="Select * from categories";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }

                    ?>
                    
                    
                </select>
                
            </div>

            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-control mt-3">
                    <option value="">Select brands</option>
                    <?php
                    $select_query="Select * from brands";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $brand_title=$row['brand_title'];
                        $brand_id=$row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }

                    ?>
                    
                </select>
                
            </div>

            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label mt-3">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"
                required="required">
            </div>

            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label mt-3">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"
                required="required">
            </div>

            <!-- Image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label mt-3">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control"
                required="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label mt-3">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                 placeholder="Enter product Price" autocomplete="off" required="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn text-light mt-3 mb-4 px-3" value="Insert Product" style="background-color: #006400;">
            </div>
        </form>
    </div>
</body>
</html>