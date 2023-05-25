<?php
include_once("../../php/staticInfo.php");
    if(isset($_GET['id'])){
        $connection = new mysqli($servername, $dbusername, $dbPassword, $database);
        $query = $connection ->prepare("DELETE FROM `products` WHERE `productID` = ?;");
        $query->execute(array($_GET['id']));
    }
    header("location: ../adminPage.php");
?>