<?php
    function addOrder($userID, $address, $method){
        include("../staticInfo.php");
        if(getTotalPrice($userID) == false){
            echo "cart is empty";
        }else{
            $orderID = getOrderID();
            $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
            $address = 'Perusha 4, Pravets 2161, Bulgaria';

            $query = "INSERT INTO `orders` (`orderID`, `userID`, `date`, `address`, `paymentMethod`, `totalPrice`, `status`) 
            VALUES ('".$orderID."', '".$userID."', '".date("Y-m-d")."', '".$address."', '".$method."', '".getTotalPrice($userID)."', 'Waiting');";

            $connection->prepare($query)->execute();
            addOrderInfo($orderID, $userID);
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
    function getTotalPrice($userID){
        
        $totalPrice = 0;
        if($userID == 0){
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
        }else{
            include("../staticInfo.php");
            $products = getCartFromDB($userID);
            if($products){
                foreach ($products as $row){
                    $totalPrice += $row['count']*getOnePrice($row['productID']);
                }
            }
            return $totalPrice;
        }
    }
    function addOrderInfo($orderID, $userID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);   
        
        $products = getCartFromDB($userID);
        foreach ($products as $product){
            $query = "INSERT INTO `orders_have_products` (`orderID`, `productID`, `currentPrice`, `quantity`) 
                        VALUES (?, ?, ?, ?);";
            $connection->prepare($query)->execute(array($orderID, $product['productID'], $product['price'], $product['count']));
            delteFromCart($userID, $product['productID']);
        } 
        // foreach (json_decode($_COOKIE['cart']) as $key => $value) {
        //     $query = "INSERT INTO `orders_have_products` (`orderID`, `productID`, `quantity`) 
        //                 VALUES ('?', '?', '?', '?');";
        //     $connection->prepare($query)->execute($orderID, $key, $value);
        // }
    }
    function getOnePrice($id){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $data = $connection -> query('SELECT price FROM products WHERE productID ='.$id.'')->fetch();

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
                    $productsPrice = $connection -> query('SELECT price, name FROM products WHERE productID ='.$key.'');

                    foreach ($productsPrice as $row){
                        echo "<p> ".$row['name']." -> ".$row['price']." </p>";
                    }
                }
            }
        }
    }
    function getCartFromDB($userID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
    
        if (!$connection) {
          die("Connection failed");
        }
    
        $query = "SELECT cartID FROM cart where userID = ?";
        $getID = $connection -> prepare($query);
        $getID -> execute(array($userID));
        $idArr = $getID -> fetch();

        if($idArr){
            $id = $idArr[0];
        
            $query2 = "SELECT * FROM products as p
            INNER JOIN cart_has_products as c
            ON p.productID = c.productID WHERE c.cartID = ?;";
            $data = $connection -> prepare($query2);
            $data -> execute(array($id));
            $products = $data -> fetchAll();

            return $products;
        }else{
            return null;
        }
    }
    function getCart($userID){
        if($userID == 0){
            $products = getCartFromCookie();
        }else{
            $products = getCartFromDB($userID);
        }
        if($products){
            return $products;
        }else{
            return null;
        }
    }
    function displayCart($userID){
        $products = getCart($userID);
        if($products){
            foreach( $products as $product) {?>
                    <div>
                    <a style="text-decoration:none; color:black" href ="../../indProdPage.php?id=<?php echo $product['productID']?>">
                            <img style="max-width: 100px; height: auto;" src="../../<?php echo $product['img_src']?>"></h1>
                            <p>Name: <?php echo $product['name']?></p>
                            <p>Price: <?php echo $product['price']?></p>
                        </a>
                        <?php
                        if($userID == 0){?>
                            <input id="qtyID<?php echo $product['productID']?>" onchange="changeCart(<?php echo $product['productID']?>, getQty(<?php echo $product['productID']?>))" type="number" name="count" value="<?php echo $product['count']?>">
                            <script src="../../js/shoppingCart.js"></script>
                            <script>
                                function getQty(id){
                                    wantedQty = parseInt(document.getElementById("qtyID"+id).value);
                                    return wantedQty;
                                }
                            </script>
                        <?php                        
                        }else{
                        ?>
                        <form action="updateCart.php?id=<?php echo $product['productID']?>" method="post">
                            Count:<input type="number" name="count" value="<?php echo $product['count']?>">
                        </form>
                        <?php
                        } 
                        ?>
                    </div>
                <?php
            }
            echo "Total Price is: ".getTotalPrice($userID);
        }else{?>
            <h1>Cart is empty</h1>
        <?php
        }
    }
    function displayCartInDrop($userID){
        $products = getCart($userID);
        if($products){
            foreach( $products as $product) {?>
                    <div>
                        <a style="text-decoration:none; color:black" href ="../../indProdPage.php?id=<?php echo $product['productID']?>">
                            <img style="max-width: 60px; height: auto;" src="../../<?php echo $product['img_src']?>"></h1>
                            Name: <?php echo $product['model']?>
                            Price: <?php echo $product['price']?>
                            
                        </a>
                        <form action="updateCart.php?id=<?php echo $product['productID']?>" method="post">
                                Count:<input type="number" name="count" value="<?php echo $product['count']?>">
                        </form>
                    </div>
                <?php
            }
            echo "Total Price is: ".getTotalPrice($userID);
        }else{?>
            <h1>Cart is empty</h1>
        <?php
        }
    }
    function getCartFromCookie(){
        if(isset($_COOKIE['cart'])){
            $cookieData = json_decode($_COOKIE['cart']);
            $try = (array) $cookieData;
            if($try){
                include_once("../staticInfo.php");
                $idArr = array();
                
                foreach($cookieData as $key => $value){
                    $idArr[] = intval($key);
                }
                $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
                $query = 'SELECT * FROM products WHERE productID IN ('.implode(",",$idArr).');';
                $DBdata = $connection-> prepare($query);

                $DBdata ->execute(array());
                $DBdata->setFetchMode(PDO::FETCH_ASSOC);
                $products = $DBdata -> fetchAll();
                
                foreach($cookieData as $id => $count){  
                    foreach($products as $key => $value){
                        if($value['productID'] == $id){
                            $products[$key]['count'] = $count;
                        }
                    }
                }

                return $products;
            }else{
                return null;
            }
        }
    }
    function getNextFreeCartID(){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $query = "SELECT cartID FROM cart order by cartID desc limit 1;";
        $data = $connection->query($query) -> fetch();
        if($data != false){
            $cartID = $data[0] + 1;
        }else{
            $cartID = 1;
        }
        return $cartID;
    }
    function addCartForUser($userID, $cartID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);      
        
        $query = "INSERT INTO `cart` (`cartID`, `userID`) VALUES (?, ?);";
        $connection->prepare($query)->execute(array($cartID, $userID));    
    }
    function checkCartId($userID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $query = "SELECT cartID FROM cart where userID = ?";
        $getID = $connection -> prepare($query);
        $getID -> execute(array($userID));
        $idArr = $getID -> fetch();

        if($idArr){
            $cartID = $idArr[0];
        }else{
            $cartID = getNextFreeCartID();
            addCartForUser($userID, $cartID);
        }
        return $cartID;
    }
    function checkProduct($userID, $productID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $query = "SELECT count FROM cart_has_products WHERE cartID = ".checkCartId($userID)." AND productID = ".$productID.";";
        $data = $connection->query($query); 
        $bool = $data -> fetch();
        if($bool){
            echo $bool[0];
            return $bool[0];
        }else{
            return null;
        }
    }
    function checkAction($userID, $productID, $count){
        if(checkProduct($userID, $productID) != null || checkProduct($userID, $productID) === 0){
            if($count > 0){
                updateProduct($userID, $productID, checkProduct($userID, $productID), $count);
            }
        }else if($count > 0){
            addProductToCart($userID, $productID, $count);
        }
    }
    function updateProduct($userID, $productID, $oldCount, $newCount){
        $count = $oldCount + $newCount;
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);      
        
        $query = "UPDATE cart_has_products SET count = ? WHERE productID = ? AND cartID = ?;";
        $connection->prepare($query)->execute(array($count, $productID, checkCartId($userID))); 
    }
    function addProductToCart($userID, $productID, $count){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);      
        
        $query = "INSERT INTO `cart_has_products` (`cartID`, `productID`, `count`) VALUES (?, ?, ?);";
        $connection->prepare($query)->execute(array(checkCartId($userID), $productID, $count));
    }
    function updatefromOrderPage($userID, $productID, $newCount){
        if($newCount <= 0){
            delteFromCart($userID, $productID);
        }else{
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);      
        
        $query = "UPDATE cart_has_products SET count = ? WHERE productID = ? AND cartID = ?;";
        $connection->prepare($query)->execute(array($newCount, $productID, checkCartId($userID))); 
        }
    }
    function delteFromCart($userID, $productID){
        include("../staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);    
        $cartID = checkCartId($userID);
        $query = "DELETE FROM cart_has_products WHERE productID = ? AND cartID = ?;";

        $connection->prepare($query)->execute(array($productID, $cartID));
    }
?>

<!-- <script src="../js/shoppingCart.js"></script>

<script>
    deleteCart();
</script> -->
