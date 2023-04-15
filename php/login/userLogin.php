<?php
include_once("../staticInfo.php");
include_once("../User/user.php");

$connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

session_start();
   $username = $_POST['username'];
   $password = $_POST['password'];
   $error2 = false;

   $checkType = $connection->query("SELECT userTypeID FROM users WHERE username = '" . $username . "'")->fetch();

   if($checkType){
        $query = "SELECT userID, username, email, userTypeID FROM users  WHERE username = '".$username."' AND password = '".$password."'";
        $info = $connection->query($query)->fetch();
        if($info){
           $user = new User($info['userID'], $info['username'],$info['email'],$info['userTypeID']);
           $_SESSION['user'] = serialize($user);
           header("location: ../../admin/adminPage.php");
        }else{
           $_SESSION['loginError'] = "incorrect login info";
           header("location: ../../admin/index.php");
        }
    }else{
       $_SESSION['loginError'] = "There is no such account";
    }
?>