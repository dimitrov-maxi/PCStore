<?php
include_once("../php/staticInfo.php");
include_once("../php/User/user.php");

$connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

session_start();
if(isset($_SESSION['user'])){
   $user = unserialize($_SESSION['user']);
   $type = $user -> getType();
   if($type == 2 || $type == 3){
      header("location: adminPage.php");
   }
}
// error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/adminLogin.css?<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <title>Administration</title>
</head>

<body style="background-color: #2C3E50;">

   <div class="form-wrap">
      <h3>Login</h3>
      <!-- LOGIN --->
      <form class="login-form" action="../php/login/adminLogin.php" method="post">
         <input name="username" type="text" class="input" id="user_login" autocomplete="off" placeholder="Username">
         <input name="password" type="password" class="input" id="user_pass" autocomplete="off" placeholder="Password">
         <input type="submit" name='login' class="button" value="Login"><br>
         <?php 
            if ($error2 = true){
               echo "<p>Incorrect password or username</p>";
         }
         ?>
      </form>
   </div>
</body>

