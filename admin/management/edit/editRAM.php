<?php
    include("../../../php/staticInfo.php");
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);   

    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $frequency = $_POST['frequency'];
    $latency = $_POST['latency'];
    $type = $_POST['type'];

    $query ="UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?, `model` = ?, `manufacturer` = ?  WHERE (`productID` = ?);";
    $query2 ="UPDATE `RAM` SET `frequency` = ?,`latency` = ?,`type` = ? WHERE (`productID` = ?);";

    $connection->prepare($query)->execute(array($name, $price, $quantity, $model, $manufacturer, $id));
    $connection->prepare($query2)->execute(array($frequency, $latency, $type, $id));

    header("location: ../../adminPage.php");
?>