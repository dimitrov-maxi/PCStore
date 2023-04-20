<?php
include_once("orderUtil.php");
$orderID = $_GET['orderID'];
$status = $_POST['status'];
    changeStatus($orderID, $status);
    header("location: viewOrder.php?orderID=".$orderID."");
    // header("location:javascript://history.go(-1)");
?>