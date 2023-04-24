<?php
include("header.php");
if (isset($_SESSION['user'])){
    include_once("php/staticInfo.php");
    include_once("php/User/user.php");
    include_once("admin/orderManagment/orderUtil.php");
    $user = unserialize($_SESSION['user']);
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
    $orders = $connection -> query('SELECT * FROM orders WHERE userID = '.$user->getUserID().';');

    echo "Hi ".$user -> getUsername();
    ?>
    <div class = >
        <table>
            <tr>
                <th>Orders</th>
            </tr>
            <tr class="row">
                <td class = "col">OrderID</td>
                <td class = "col">UserID</td>
                <td class = "col">Order Date</td>
                <td class = "col">Shipping address</td>
                <td class = "col">Payment Method</td>
                <td class = "col">Total Order Price</td>
                <td class = "col">Status</td>
                <td class = "col"></td>
            </tr>
                <?php
                foreach($orders as $row2){
                    ?>
                    <tr class = "row">
                        <td class = "col"><?= $row2['orderID']?></td>
                        <td class = "col"><?= $row2['userID']?></td>
                        <td class = "col"><?= $row2['date']?></td>
                        <td class = "col"><?= $row2['address']?></td>
                        <td class = "col"><?= $row2['paymentMethod']?></td>
                        <td class = "col"><?= $row2['totalPrice']?></td>
                        <td class = "col"><?= $row2['status']?></td>
                        <td class = "col"><a href="php/User/userOrderInfo.php?orderID=<?= $row2['orderID']?>">View</a></td>
                    </tr><br>
                    <?php
                }
                ?>
        </table>
    </div>
    <?php
}else{
    header("location: login.php");
}
?>