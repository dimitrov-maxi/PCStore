<?php
    include_once("cartFunct.php");
    // function addOrder($user, $address, $method){
    //     include("staticInfo.php");
    //     if(getTotalPrice() == false){
    //         echo "cart is empty";
    //     }else{
    //         $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
    //             // foreach (json_decode($_COOKIE['cart']) as &$value) {
    //             //     echo $value;
    //             // }

                
    //             $address = 'Perusha 4, Pravets 2161, Bulgaria';

    //         // $connection -> prepare("INSERT INTO `orders` (`orderID`, `userID`, `date`, `address`, `paymentMethod`, `totalPrice`) 
    //         // VALUES (NULL, '".$userID."', '".date("Y-m-d")."', '".$address."', '".$method."', '".getTotalPrice()."', 'Waiting');");

    //         $query = "INSERT INTO `orders` (`orderID`, `userID`, `date`, `address`, `paymentMethod`, `totalPrice`, `status`) 
    //         VALUES (NULL, '".$user."', '".date("Y-m-d")."', '".$address."', '".$method."', '".getTotalPrice()."', 'Waiting');";

    //         $connection->prepare($query)->execute();
    //     }
        
    // }
    // function getTotalPrice(){
    //     include("staticInfo.php");
    //     $totalPrice = 0;
    //     $cart = json_decode($_COOKIE['cart']);
        
    //     if (is_null($cart)){
    //         return false;
    //     }elseif(is_int($cart)){
    //         $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
    //         $productsPrice = $connection -> query('SELECT price FROM pcstoreproject.products WHERE productID ='.$cart.'');

    //         foreach ($productsPrice as $row){
    //             $totalPrice += $row['price'];
    //             echo "<p> ".$cart." -> ".$row['price']." </p>";
    //         }

    //     }elseif(is_array($cart)){
    //         foreach (json_decode($_COOKIE['cart']) as $value) {
    //             $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
    //             $productsPrice = $connection -> query('SELECT price FROM pcstoreproject.products WHERE productID ='.$value.'');
    //             var_dump($productsPrice);

    //             foreach ($productsPrice as $row){
    //                 $totalPrice += $row['price'];
    //                 echo "<p> ".$value." -> ".$row['price']." </p>";
    //             }
    //         }
    //         return $totalPrice;
    //     }
    // }
    // function addOrderInfo($userID){
    //     $orderInfo = "INSERT INTO `orders_have_products` (`orderID`, `productID`, `currentPrice`, `quantity`) 
    //                     VALUES ('1', '1', '400', '1'), ('1', '2', '300', '1');";
        
    //     foreach (json_decode($_COOKIE['cart']) as $value) {
    //         $connection = new PDO('mysql:host=localhost:3307;dbname=pcstoreproject',"root","");
    //         $productPrice = $connection -> query('SELECT price FROM pcstoreproject.products WHERE productID ='.$value.'');
    //         foreach ($productPrice as $row){
    //             // $totalPrice += $row['price'];
    //             echo "<p> ".$value." -> ".$row['price']." </p>";
    //         }
    //     }
    // }

    $address = $_POST['address'];
    $paymentMethod = $_POST['paymentMethod'];

    if (!$address) {
        $error = "No address!";
    }
    if (!$paymentMethod) {
        $error = "No payment method selected!";
    }
    print_r($address);
    print_r($paymentMethod);
?>
