<?php
    include("../../../php/staticInfo.php");
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);   

    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $socketID = floatval($_POST['socketID']);
    $chipsetID = $_POST['chipsetID'];
    $type = $_POST['type'];

    // 
    $target_dir = "../../../Pictures/Products/MOBO/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["picture"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["picture"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
    }
    if($uploadOk == 0){
        $query ="UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?, `model` = ?, `manufacturer` = ? WHERE (`productID` = ?);";
        $connection->prepare($query)->execute(array($name, $price, $quantity, $model, $manufacturer, $id));
    }else{
        $srcAddress = "Pictures/Products/MOBO/".$_FILES['picture']['name'];
        $query ="UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?, `model` = ?, `manufacturer` = ?, `img_src` = ?  WHERE (`productID` = ?);";
        $connection->prepare($query)->execute(array($name, $price, $quantity, $model, $manufacturer, $srcAddress, $id));
    }   

    $query2 ="UPDATE `motherboards` SET `socketID` = ?,`chipsetID` = ?,`supported_memory` = ? WHERE (`productID` = ?);";
    $connection->prepare($query2)->execute(array($socketID, $chipsetID, $type, $id));

    header("location: ../../adminPage.php");
?>