    <?php
    function getOrderInfo($orderID){
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
    function changeStatus($orderID, $status){
        include_once("../../php/staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);      
        
        $query = "UPDATE orders `order` SET status = ? WHERE orderID = ?;";
        $connection->prepare($query)->execute(array($status, $orderID)); 
    }
    function getStatus($orderID){
        include("../../php/staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

        $query = "SELECT status FROM `orders` WHERE orderID = ?;";
        $data = $connection -> prepare($query);
        $data -> execute(array($orderID));
        $status = $data -> fetchAll();

        return $status[0]['status'];
    }
?>