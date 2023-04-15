<?php
include_once("php/staticInfo.php");

$search = @$_GET['search'];
$connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);

$id = $_GET['id'];

$obj = $connection->prepare('SELECT * FROM products where productID = ? ');
    

$obj->execute([$id]);
$itm = $obj->fetch();

$categoryID = $itm['categoryID'];

$getCategoryName = $connection->prepare('SELECT category_name FROM category where categoryID = ?');

$getCategoryName->execute([$categoryID]);
$categoryName = $getCategoryName->fetch();
$category = $categoryName['category_name']

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('header.php');
    ?>
</head>

<body class="theme">
    
    <!-------      ITEM PREVIEW           ---->


    


    <div class="container">
        <div class="preview" >
            <div class="row" >
                <h1>
                    <?= $itm['name'] ?>
                </h1> 
            </div>
                <div class="row">
                    <div class="col" class="previewPic" style="width:100%; max-width: 350;">
                        <img src="<?= $itm['img_src'] ?>" class="previewPic">
                    </div>
                    <div class="col-md" style="background-color: #3498db; border-radius: 10px; padding: 10px;">
                        <div class="row">
                            <h6 style="font-size: 35px;">
                                Manufacturer: <?= $itm["manufacturer"] ?>
                            </h6>
                        </div>
                    <?php switch($category){
                        case 'CPU':
                            $query2 = $connection->prepare('SELECT * FROM cpus WHERE productID = ?;');
                            $query2->execute([$id]);
                            $stats = $query2->fetch();

                            $query3 = $connection->prepare('SELECT socket_name FROM sockets where socketID = ?;');
                            $query3->execute([$stats["socketID"]]);
                            $socket = $query3->fetch();
                            
                            echo '
                                <div class="row">
                                    <h6 style="font-size: 30px;">
                                        Family:'.$stats["series"].'
                                    </h6>
                                </div>

                                <div class="row">
                                    <h6 style="font-size: 30px;">
                                        Core Count:'.$stats["core_count"].'
                                    </h6>
                                </div>

                                <div class="row">
                                    <h6 style="font-size: 30px;">
                                        Thread Count: '.$stats["thread_count"].'
                                    </h6>
                                </div>

                                <div class="row">
                                    <h6 style="font-size: 30px;">
                                        Base Frequency: '.$stats["base_clock"].' GHz
                                    </h6>
                                </div>

                                <div class="row">
                                    <h6 style="font-size: 30px;">
                                        Boost Frequency: '.$stats["boost_clock"].' GHz
                                    </h6>
                                </div>  

                                <div class="row">
                                    <h6 style="font-size: 30px;">
                                        Socket: '.$socket["socket_name"].'
                                    </h6><br><br><br>
                                </div>';
                            break;
                        case 'GPU':
                            echo ' ';
                            break; 
                        case 'GPU':
                            echo ' ';
                            break;
                        case 'GPU':
                            echo ' ';
                            break;                   
                        } 
                        ?>
                        
                        <div class="row" style="float: right; background-color: #E74C3C; margin-left:1px; border-radius: 15px ">

                                <div class="h6" style="font-size: 50px;">
                                    Price: <?= $itm['price']?> BGN
                                    
                                </div>
                                <button onclick="addToCart(<?php echo $id?>, wantedQty)">Add to cart</button>
                                <input onchange="getNewQty()" id="qty<?php echo $id?>" type="number" value=1 >
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>

<script src="js/shoppingCart.js"></script>
<script>
let wantedQty = parseInt(document.getElementById("qty<?php echo $id?>").value);
function getNewQty(){
    wantedQty = parseInt(document.getElementById("qty<?php echo $id?>").value);   
    console.log(wantedQty);
}

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
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
</script>
</html>
