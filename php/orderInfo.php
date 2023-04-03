<?php
    include_once("cartFunct.php");
    displayOrder();
    echo "Total Price is: ".getTotalPrice();
   ?>

<form action="finishOrder.php" method="post">
    Address <input type="text" name="address"><br>
    Payment Method <input type="text" name="paymentMethod"><br>
    <button>Finish order</button>
</form>