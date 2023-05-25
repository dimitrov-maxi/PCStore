<?php
    include("../../../php/staticInfo.php");
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);   

    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $img_src = "";
    $powerRatingID = intval($_POST['PowerRatings_ratingID']);
    $wattage = $_POST['wattage'];
    $type = $_POST['type'];

    $query ="UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?, `model` = ?, `manufacturer` = ?  WHERE (`productID` = ?);";
    $query2 ="UPDATE `PSUs` SET `PowerRatings_ratingID` = ?,`wattage` = ?,`type` = ? WHERE (`productID` = ?);";

    var_dump($powerRatingID, $wattage, $type, $id);

    $connection->prepare($query)->execute(array($name, $price, $quantity, $model, $manufacturer, $id));
    $connection->prepare($query2)->execute(array($powerRatingID, $wattage, $type, $id));

    header("location: ../../adminPage.php");
?>