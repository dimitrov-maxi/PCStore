<?php
include_once("php/staticInfo.php");
$connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

session_start();


error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING);

   $username = $_POST['username'];
   $password = $_POST['password'];
   $error2 = false;

   $query = "SELECT * FROM admins WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
   

   $user = $connection->query($query)->fetch();

   if ($user) {
      $_SESSION['user'] = $user;

      header("location:../PcStore/adminPage.php");

   } else {
     $error2 = true;
   }

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/adminLogin.css?<?php echo time(); ?>">
    <title>Administration</title>
</head>

<body style="background-color: #2C3E50;">
<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>


<div class="form-wrap">
        <h3>Login</h3>
      </div>


        <!-- LOGIN --->
        <div id="login-tab-content">
            <form class="login-form" action="" method="post">
               <input name="username" type="text" class="input" id="user_login" autocomplete="off" placeholder="Username">
               <input name="password" type="password" class="input" id="user_pass" autocomplete="off" placeholder="Password">
               
               <input type="submit" name='login' class="button" value="Login"><br>

               <?php 
                  if ($error2 = true){
                     echo "<p>Incorrect password or username</p>";
               }
               ?>
            </form>
            <div class="help-text"></div>
         </div>
      </div>
   </body>

