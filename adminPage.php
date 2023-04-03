<?php
include_once("php/staticInfo.php");
$search = @$_GET['search'];

        $connections = new mysqli($servername, $dbusername, $dbPassword, $database);
        // Check connection
        if ($connections->connect_error) {
            die("Connection failed: " . $connections->connect_error);
        }

$rows = $connections -> query('SELECT * FROM products LEFT JOIN category ON products.categoryID = category.categoryID;');
// $categories = $connections -> query('SELECT * FROM products LEFT JOIN categories ON products.categoryID = categories.categoryID');
$orders = $connections -> query('SELECT * FROM pcstoreproject.orders;');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/admin.css?<?php echo time(); ?>">
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <title>Admin Page</title>
</head>

<body style="font-family: Comic Sans MS;"> <!--- style="background-color: #2C3E50;->
    <! Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>



    <div class="dash">
        <div class="row">
        <div class="col">
            <div class="dashText">
                <h2>Dashboard</h2>
            </div>
                <div>
                    <button onclick="viewProducts()" class="dashBtn"> View Products</button>
                    <button onclick="addProductsMenu()" class="dashBtn"> Add Products</button>
                    <button onclick="showSales()" class="dashBtn">Sales</button>
                    <button onclick="window.location.href = '#addAdmin'" class="dashBtn"> Add Admin</button>
                    <button onclick="window.location.href = '#settings'" class="dashBtn"> Settings</button>  
                </div>
            </div>
        </div>
    </div>
    

    <div id="products">
        <table>
            <tr>
                <th>Products</th>
            </tr>
            <tr class="row">
                <td class = "col">Product ID</td>
                <td class = "col">Category</td>
                <td class = "col">Name</td>
                <td class = "col">Price</td>
                <td class = "col">Quantity</td>
                <td class = "col">Manufacturer</td>
                <td class = "col">Model</td>
                <td class = "col">Image</td>
                <td class = "col"></td>
                <td class = "col"></td>
            </tr>
                <?php
                foreach($rows as $row){
                    ?>
                    <tr class = "row">
                        <td class = "col"><?= $row['productID']?></td>
                        <td class = "col"><?= $row['category_name']?></td>
                        <td class = "col"><?= $row['name']?></td>
                        <td class = "col"><?= $row['price']?></td>
                        <td class = "col"><?= $row['quantity']?></td>
                        <td class = "col"><?= $row['manufacturer']?></td>
                        <td class = "col"><?= $row['model']?></td>
                        <td class = "col"><img src="<?= $row['img_src']?>" style="width: 200px"></td>
                        <td class = "col"><a href="edit.php?id=<?= $row['productID']?>">Edit</a></td>
                        <td class = "col"><a href="deleteProduct.php?id=<?= $row['productID']?>">Delete</a></td>
                    </tr><br>
                    <?php
                }
                ?>
        </table>
    </div>

    <div id="addProductsMenu">
        <a href="product managment/addCPU.php"><button>ADD NEW CPU</button></a>
        <button>ADD NEW GPU</button>
        <button>ADD NEW MOBO</button>
        <button>ADD NEW PSU</button>
        <button>ADD NEW RAM</button>
        <button>ADD NEW Storage</button>
        <button>ADD NEW Cooling</button>
    </div>

    <div id="viewSales" class="sales">
        <canvas id="salesChart" style="width:100%;max-width:600px;"></canvas>

        <table>
            <tr>
                <th>Orders</th>
            </tr>
            <tr class="row">
                <td class = "col">OrderID</td>
                <td class = "col">UserID</td>
                <td class = "col">Order Date</td>
                <td class = "col">Shipping address</td>
                <td class = "col">Payment Method</td>
                <td class = "col">Total Order Price</td>
                <td class = "col">Status</td>
                <td class = "col"></td>
            </tr>
                <?php
                foreach($orders as $row2){
                    ?>
                    <tr class = "row">
                        <td class = "col"><?= $row2['orderID']?></td>
                        <td class = "col"><?= $row2['userID']?></td>
                        <td class = "col"><?= $row2['date']?></td>
                        <td class = "col"><?= $row2['address']?></td>
                        <td class = "col"><?= $row2['paymentMethod']?></td>
                        <td class = "col"><?= $row2['totalPrice']?></td>
                        <td class = "col"><?= $row2['status']?></td>
                        <td class = "col"><a href="viewOrder.php?id=<?= $row2['orderID']?>">View</a></td>
                    </tr><br>
                    <?php
                }
                ?>
        </table>
    </div>

    <script>
        let days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        let weekSales = [200, 350, 500, 100, 125, 250, 10];
        let colors = [];
        for (i in weekSales) {
            if(weekSales[i] >= 350){
                colors.push("green");
            }
            else if(weekSales[i] < 350 && weekSales[i] > 150){
                colors.push("orange");
            }
            else if(weekSales[i] < 150){
                colors.push("red");
            }
        }
        
        new Chart("salesChart", {
            type: "bar",
            data: {
                labels: days,
                datasets: [{
                backgroundColor: colors,
                data: weekSales
                }]
            },
            options: {
                legend: {display: false},
                title: {
                display: true,
                text: "Last week sales"
                }
            }
        });

    </script>
<!-- ----------------------------------- -->
    <script>
        function hideAll(){
            document.getElementById("viewSales").style.display = "none";
            document.getElementById("products").style.display = "none";
            document.getElementById("addProductsMenu").style.display = "none";
        }
        hideAll();
        viewProducts();
        function viewProducts(){
            hideAll();
            document.getElementById("products").style.display = "block";
        }
        function addProductsMenu(){
            hideAll();
            document.getElementById("addProductsMenu").style.display = "block";

        }
        function showSales() {
            hideAll();
            document.getElementById("viewSales").style.display = "block";
        }
        function addAdminPage() {
            hideAll();
            document.getElementById("products").style.display = "none";
        }
        function settingsPage(){
            hideAll();
        }
        function logout(){

        }
    </script>
</body>