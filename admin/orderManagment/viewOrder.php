<a href="../adminPage.php">Go Back</a>
<table>
    <tr>
        <th>Order info</th>
    </tr>
<?php
    include_once("orderUtil.php");

    $orderID = $_GET['orderID'];
    $order = getOrderInfo($orderID);
    $status = getStatus($orderID);
    ?>
        <tr>
            
            <td><form action="changeStatus.php?orderID=<?php echo $orderID;?>" method="post">
            <label for="options">Status </label>
            <select id="options" name="status">
                <option value="Waiting" <?php if($status == 'Waiting') echo 'selected'; ?>>Waiting</option>
                <option value="Sent" <?php if($status == 'Sent') echo 'selected'; ?>>Sent</option>
                <option value="Delivered" <?php if($status == 'Delivered') echo 'selected'; ?>>Delivered</option>
                <option value="Completed" <?php if($status == 'Completed') echo 'selected'; ?>>Completed</option>
            </select>
            Update <input type="submit">
        </form></td>
        </tr>
    <?php
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