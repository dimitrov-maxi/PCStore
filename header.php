<?php
include_once("php/User/user.php");
session_start();

if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
    $username = $user -> getUsername();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css?php echo time(); ?>">
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <title>PcStore</title>
</head>

<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/117970980f.js" crossorigin="anonymous"></script>

<!--- HEADER ---->
<script src="js/shoppingCart.js"></script>

<div class="switch" style="position: absolute; right: 0">
    <label class="theme-switch" for="checkbox">
    <input type="checkbox" id="checkbox" />
        <div class="slider round"></div>
    </label>
</div>

<div class="container-fluid mx-auto text-center">
    <a href="index.php">
        <img src="Pictures\Main Page\logo6v3.png" class="logo">
    </a>    
</div>

<div class="navigation">
    <div class="row">
        <div class="col">
            <div class="dropdown">
                <button onmouseover="showDropown()" class="dropBtn dropBtnTxt hideMobile">Components</button>
                <img onmouseover="showDropown()" class = "menuBtn dropbtn showMobile hideDesktop" src="Pictures/Main Page/menu.png">

                <div id="myDropdown" class="dropdown-content">
                    <a href="?category=CPU">Processors</a>
                    <a href="?category=MOBO">Motherboards</a>
                    <a href="?category=RAM">RAM</a>
                    <a href="?category=PSU">Power suplies</a>
                    <a href="?category=GPU">Videocards</a>
                    <a href="?category=Storage">Storage</a>
                    <a href="?category=Cooling">Cooling</a>
                </div>
            </div>
        </div>

        <div class="col">
            <form action="index.php">
                <div class="input-group rounded search showMobile">
                    <input type="text" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" autocomplete="off"/>
                </div>
            </form>
        </div>

        <div class="col">
            <img onmouseover="showCart()" onclick="goToBuyPage()" class="menuBtn cartBtn" src="Pictures\Main Page\cart.png">
                <div id="myCart" class="cartContent hide">
                    <h1>Cart is empty</h1>
                </div>
        </div>

        <div class="col">
            <div id=login>
            <?php 
                    if(isset($username)){?>
                        <img onmouseover="showLogin()" class="loginBtn" src="Pictures\Main Page\login_v3.gif">
                        <h2 id="userGreet" class="userGreet hide">Hi <?php echo $username; ?></h2>
                        <?php
                    }else{
                        ?>
                        <a href="login.php" class="loginbtn">
                        <!-- <img class="loginBtn static" src="Pictures\Main Page\login_v3.png"> -->
                        <img class="loginBtn" src="Pictures\Main Page\login_v3.gif">
                        <h2 id="userGreet" class="userGreet hide">You are not logged in</h2>
                        </a>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------- -->
<script>
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);
    
        if (currentTheme === 'light') {
            toggleSwitch.checked = true;
        }
    }

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
        else {        
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        }    
    }

    function showCart() {
        document.getElementById("myCart").classList.toggle("show");
        document.getElementById("myCart").classList.toggle("hide");
    }
    //     cart = JSON.parse(getCookie('cart'));
    //     let text;
    //     for (let [key, value] in cart){
    //         console.log(key, value);
    //         text += `<a href="indProdPage.php#${key}">prodID = ${key}</a>`
    //     }
    //     document.write.getElementById="myCart" = text;
    // }

    // window.onclick = function(event) {
        //     if (!event.target.matches('.cartBtn')) {
        //         var dropdowns = document.getElementsByClassName("cart-content");
        //         var i;
        //         for (i = 0; i < dropdowns.length; i++) {
        //             var openDropdown = dropdowns[i];
        //             if (openDropdown.classList.contains('show')) {
        //                 openDropdown.classList.remove('show');
        //             }
        //         }
        //     }
        // }
    // ---------------------------------------------------------
    function showDropown() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    function showLogin(){
        document.getElementById("userGreet").classList.toggle("show");
    }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

    toggleSwitch.addEventListener('change', switchTheme, false);

    function goToBuyPage() {
        location.href = "php/cart/orderInfo.php";
    }
</script>
<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("myCart").click(function(){
    $.ajax({url: "demo_test.txt", success: function(result){
      $("#div1").html(result);
    }});
  });
});
</script>
</head>
<body> -->
