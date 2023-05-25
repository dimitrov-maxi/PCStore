<?php
    function getNextFreeID($servername, $database, $dbusername, $dbPassword){
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $query = "SELECT productID FROM products order by productID desc limit 1;";
        $data = $connection->query($query) -> fetch();
        if($data != false){
            $cartID = $data[0] + 1;
        }else{
            $cartID = 1;
        }
        return $cartID;
    }
?>