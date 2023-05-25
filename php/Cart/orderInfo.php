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
    session_start();
    include_once("cartFunct.php");
    if(isset($_SESSION['user'])){
        include_once("../User/user.php");
        $userID = unserialize($_SESSION['user']) -> getUserID();
        displayCart($userID);
    }else{
        displayCart(0);
    }
       ?>

    <form action="finishOrder.php" method="post">
        Address <input type="text" name="address"><br>
        Payment Method: <select name="" id="">                   
                            <option value="delivery">at delivery</option>
                            <option disabled value="card">Card</option>
                        </select><br>
         <!-- <input type="text" name="paymentMethod"><br> -->
        <button>Finish order</button>
    </form>
</body>
</html>
