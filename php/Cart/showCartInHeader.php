<?php
    include_once("../User/user.php");
    include_once("cartFunct.php");
    session_start();
    if(isset($_SESSION['user'])){
        $userID = unserialize($_SESSION['user']) -> getUserID();
        displayCartInDrop($userID);
        
        // echo json_encode($data);

        // $query2 = "SELECT productID, count FROM cart_has_products where cartID = ?";
        // $products = $connection -> prepare($query2);
        // $products -> execute(array($id[0]));
        // $rows = $products -> fetchAll();
        // $data = array();
        // $prodIDs = array();

        // foreach( $rows as $value ) {
        //     $data[$value['productID']] = $value['count'];
        //     $prodIDs[] = $value['productID'];
        //     echo "<a href ='indProdPage.php?id=".$value['productID']."' >Product</a>";
        // }
        // $query3 = "SELECT * FROM products where productID = ?";
        // $products2 = $connection -> prepare($query3);
        // $products2 -> execute($prodIDs);
        // $showInfo = $products2 -> fetchAll();

        // foreach( $showInfo as $info ) {
        //     $data[$value['productID']] = $value['count'];
        //     $prodIDs[] = $value['productID'];
        //     echo "<a href ='indProdPage.php?id=".$value['productID']."' >Product</a>";
        // }
    }else{
        displayCart(0);
    }
?>
