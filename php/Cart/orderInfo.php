<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/cart.css?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <div class="backButton">
        <a href="../../index.php">
            <img class="backButtonImg" src="../../Pictures/Main Page/cart/backButton.png" alt="">
            <h1 class="backButtonText">Back</h1>
        </a>
    </div>
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
</body>
</html>
