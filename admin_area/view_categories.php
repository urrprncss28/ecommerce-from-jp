<h3 class="text-center">CATEGORIES</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-light">
            <th>S1 no</th>
            <th>Category Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        
        $select_cat="select * from categories";
        $result=mysqli_query($con,$select_cat);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $category_id=$row['category_id'];
            $category_title=$row['category_title'];
            $number++;
        
        ?>
        <tr>
            <td><?php echo $number; ?></td>
            <td><?php echo $category_title; ?></td>
            <td><a href='index.php?edit_category=<?php echo $category_id; ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_category=<?php echo $category_id; ?>' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>