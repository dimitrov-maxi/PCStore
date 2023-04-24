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
    $thread_count = $_POST['thread_count'];
    $series = $_POST['series'];
    $socket = $_POST['socketID'];

    $query ="UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?, `model` = ?, `manufacturer` = ?  WHERE (`productID` = ?);";
    $query2 ="UPDATE `CPUs` SET `base_clock` = ?,`boost_clock` = ?,`core_count` = ?,`thread_count` = ?,`series` = ?,`socketID` = ? WHERE (`productID` = ?);";

    // var_dump($query + "q2: " + $query2)
    $connection->prepare($query)->execute(array($name, $price, $quantity, $model, $manufacturer, $id));
    $connection->prepare($query2)->execute(array($base_clock, $boost_clock, $core_count, $thread_count, $series, $socket, $id));

    header("location: ../../adminPage.php");
?>