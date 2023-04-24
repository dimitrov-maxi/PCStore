<?php
function getOrderInfo($userID){
    include_once("../../php/staticInfo.php");
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

    $query = "SELECT * FROM products as p
            INNER JOIN orders_have_products as o
            ON p.productID = o.productID WHERE o.orderID = ?;";
    $data = $connection -> prepare($query);
    $data -> execute(array($orderID));
    $products = $data -> fetchAll();

    return $products;
}
function displayUserOrder($userID){
    
}
?>