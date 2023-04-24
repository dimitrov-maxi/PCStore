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
    $base_clock = floatval($_POST['base_clock']);
    $boost_clock = $_POST['boost_clock'];
    $core_count = $_POST['core_count'];
    $series = $_POST['series'];
    $vendor = $_POST['vendor'];
    $vram = $_POST['vram'];
    $vram_type = $_POST['vram_type'];
    $connector_type = $_POST['connector_type'];

    $query ="UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?, `model` = ?, `manufacturer` = ?  WHERE (`productID` = ?);";
    $query2 ="UPDATE `GPUs` SET `base_clock` = ?,`boost_clock` = ?,`core_count` = ?,`series` = ?,`vendor` = ?,`vram` = ?, `vram_type` = ?, `connector_type` = ? WHERE (`productID` = ?);";

    $connection->prepare($query)->execute(array($name, $price, $quantity, $model, $manufacturer, $id));
    $connection->prepare($query2)->execute(array($base_clock, $boost_clock, $core_count, $series, $vendor, $vram, $vram_type, $connector_type, $id));

    header("location: ../../adminPage.php");
?>