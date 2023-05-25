<?php
    include_once('../../../php/staticInfo.php');
    include_once("funct.php");
    $id = getNextFreeID($servername, $database, $dbusername, $dbPassword);
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);   

    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $base_clock = floatval($_POST['base_clock']);
    $boost_clock = $_POST['boost_clock'];
    $core_count = $_POST['core_count'];
    $series = $_POST['series'];
    $vendor = $_POST['vendor'];
    $vram = $_POST['vram'];
    $vram_type = $_POST['vram_type'];
    $connector_type = $_POST['connector_type'];

    $target_dir = "../../../Pictures/Products/GPU/";
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

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["picture"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
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
    $query ="INSERT INTO `products`(`productID`,`name`, `price`, `quantity`, `model`, `manufacturer`, `categoryID`) VALUES (?,?,?,?,?,?, 2);";
    $connection->prepare($query)->execute(array($id, $name, $price, $quantity, $model, $manufacturer));
}else{
    $srcAddress = "Pictures/Products/GPU/".$_FILES['picture']['name'];
    $query ="INSERT INTO `products`(`productID`,`name`, `price`, `quantity`, `model`, `manufacturer`, `categoryID`, `img_src`) VALUES (?,?,?,?,?,?,2,?);";
    $connection->prepare($query)->execute(array($id, $name, $price, $quantity, $model, $manufacturer, $srcAddress));
}
    
    $query2 ="INSERT INTO `gpus` (`productID`, `base_clock`, `boost_clock`, `core_count`, `series`, `vendor`, `vram`, `vram_type`, `connector_type`) VALUES (?,?,?,?,?,?,?,?,?);";
   
    $connection->prepare($query2)->execute(array($id, $base_clock, $boost_clock, $core_count, $series, $vendor, $vram, $vram_type, $connector_type));

    header("location: ../../adminPage.php");
?>