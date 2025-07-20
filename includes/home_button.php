<?php

$currentFile = basename($_SERVER['PHP_SELF']);
$allowedFiles = ['user_login.php', 'payment.php','confirm_payment.php'];
$allowedFiles_second = ['confirm_payment.php'];

if (in_array($currentFile, $allowedFiles)) {
    function homeButton(){
        echo "<a style='text-decoration: none;' href='../index.php'><button style='margin-left: 50px; margin-top: 50px; border-radius: 8px; border: none; background-color: #006400; padding: 12px; color: #fff;'>Home</button></a>";
    }
    homeButton();
}


?>