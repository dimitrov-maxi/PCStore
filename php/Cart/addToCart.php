<?php
    include_once("cartFunct.php");
    include_once("../User/user.php");
    session_start();
    $productID = $_GET['id'];
    $user = unserialize($_SESSION['user']);
    $count= $_POST['count'];

    checkAction($user -> getUserID(), $productID, $count);

    header("location: ../../indProdPage.php?id=".$productID);
?>