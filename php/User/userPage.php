<?php
session_start();
if (isset($_SESSION['user'])){
    include_once("user.php");
    $user = unserialize($_SESSION['user']);
    echo "Hi ".$user -> getUsername();
}else{
    header("location: ../../login.php");
}
?>