<?php
    function addOrder($userID, $address, $method){
        include("../staticInfo.php");
        if(getTotalPrice() == false){
            echo "cart is empty";
        }else{
            $orderID = getOrderID();
            $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
            $address = 'Perusha 4, Pravets 2161, Bulgaria';

            $query = "INSERT INTO `orders` (`orderID`, `userID`, `date`, `address`, `paymentMethod`, `totalPrice`, `status`) 
            VALUES ('".$orderID."', '".$userID."', '".date("Y-m-d")."', '".$address."', '".$method."', '".getTotalPrice()."', 'Waiting');";

            $connection->prepare($query)->execute();
            addOrderInfo($orderID);
            echo '<script src="../../js/shoppingCart.js"></script>

            <script>
                deleteCart();
            </script>';
        }
    }
    function getOrderID(){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $query = "SELECT orderID FROM orders order by orderID desc limit 1;";
        $data = $connection->query($query) -> fetch();
        if($data != false){
            $orderID = $data[0] + 1;
        }else{
            $orderID = 1;
        }
        return $orderID;
    }
    function getTotalPrice(){
        include("../staticInfo.php");
        $totalPrice = 0;
        if(isset($_COOKIE['cart'])){
            $cart = json_decode($_COOKIE['cart']);

            if (is_null($cart)){
                return false;
            }else{
                foreach (json_decode($_COOKIE['cart']) as $key => $value) {
                    $totalPrice += getOnePrice($key)*$value;
                }
            return $totalPrice;
            }  
        }
    }
    function addOrderInfo($orderID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);      
        
        foreach (json_decode($_COOKIE['cart']) as $key => $value) {
            $query = "INSERT INTO `orders_have_products` (`orderID`, `productID`, `currentPrice`, `quantity`) 
                        VALUES ('?', '?', '?', '?');";
            $connection->prepare($query)->execute($orderID, $key, getOnePrice($key), $value);
        }
    }
    function getOnePrice($id){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $data = $connection -> query('SELECT price FROM pcstoreproject.products WHERE productID ='.$id.'')->fetch();

        return $data['price'];
    }
    function displayOrder(){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

        if(isset($_COOKIE['cart'])){
            $cart = json_decode($_COOKIE['cart']);   
            if (is_null($cart)){
                return false;
                echo "<h1>No products found</h1>";
            }else{
                $cart = json_decode($_COOKIE['cart']);
                foreach ($cart as $key => $value) {
                    $productsPrice = $connection -> query('SELECT price, name FROM pcstoreproject.products WHERE productID ='.$key.'');

                    foreach ($productsPrice as $row){
                        echo "<p> ".$row['name']." -> ".$row['price']." </p>";
                    }
                }
            }
        }
    }
?>

<!-- <script src="../js/shoppingCart.js"></script>

<script>
    deleteCart();
</script> -->
