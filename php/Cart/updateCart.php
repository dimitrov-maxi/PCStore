<?php
    include_once("cartFunct.php");
    include_once("../User/user.php");
    session_start();
    $productID = $_GET['id'];
    $user = unserialize($_SESSION['user']);
    $count= $_POST['count'];

    updatefromOrderPage($user -> getUserID(), $productID, $count);

    header("location: orderInfo.php");
?>