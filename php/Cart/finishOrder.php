<?php
    include_once("cartFunct.php");
    include_once("../User/user.php");
    session_start();    
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $address = $_POST['address'];
        $paymentMethod = $_POST['paymentMethod'];

        if (!$address) {
            $error = "No address!";
        }
        if (!$paymentMethod) {
            $error = "No payment method selected!";
        }

        addOrder($user -> getUserID(), $address, $paymentMethod);
        header("location: ../../index.php");
    }else{
        header("location: ../../login.php");
    }
?>