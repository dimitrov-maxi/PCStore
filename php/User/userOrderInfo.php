<a href="../../userPage.php">Go Back</a>
<table>
    <tr>
        <th>Order info</th>
    </tr>
<?php
    include_once("../../admin/orderManagment/orderUtil.php");

    $orderID = $_GET['orderID'];
    $order = getOrderInfo($orderID);
    $status = getStatus($orderID);
    foreach ($order as $product){?>
        <tr>
            <td><img style="max-width: 100px; width:auto;"src="../../<?php echo $product['img_src'];?>"></td>
            <td><?php echo $product['name'];?></td>
            <td>Quantity: <?php echo $product['quantity'];?></td>
        </tr>
    <?php
    }
?>
</table>