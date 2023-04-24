<?php
    include_once("../../php/staticInfo.php");
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
    $productID = $_GET['id'];
    $category = $_GET['category'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../css/edit.css" rel="stylesheet"></link>
</head>
<body>
    <?php 
        switch($category){ 
            case 'CPU':
                ?>
                    <form class="form" method="post" action="edit/editCPU.php?id=<?php echo $productID;?>" enctype="multipart/form-data">
                        <?php 
                        $query = 'SELECT * FROM CPUs as c
                                  INNER JOIN products as p on c.productID = p.productID
                                  WHERE p.productID = ?;';
                        $data = $connection -> prepare($query);
                        $data -> execute(array($productID));
                        $result = $data -> fetchAll();

                        $query2 = 'SELECT * FROM sockets';
                        $tmp = $connection -> query($query2);
                        $result2 = $tmp -> fetchAll();
                        foreach ($result as $row) {?>
                            Name: <input class="element" type='text' name='name' value='<?php echo $row['name'];?>'><br>
                            Price: <input class="element" type='number' name='price' value='<?php echo $row['price'];?>'><br>
                            Quantity<input class="element" type='number' name='quantity' value='<?php echo $row['quantity'];?>'><br>
                            Model: <input class="element" type='text' name='model' value='<?php echo $row['model'];?>'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer' value='<?php echo $row['manufacturer'];?>'><br>
                            Base clock: <input class="element" type='number' step="any" name='base_clock' value='<?php echo $row['base_clock'];?>'><br>
                            Boost clock: <input class="element" type='number' step="any" name='boost_clock' value='<?php echo $row['boost_clock'];?>'><br>
                            Cores: <input class="element" type='number' name='core_count' value='<?php echo $row['core_count'];?>'><br>
                            Threads: <input class="element" type='number' name='thread_count' value='<?php echo $row['thread_count'];?>'><br>
                            Series: <input class="element" type='text' name='series' value='<?php echo $row['series'];?>'><br>
                            Socket:<select class="element" name="socketID">
                                    <?php
                                    foreach($result2 as $sockets){?>
                                        <option 
                                            <?php 
                                            if($row['socketID'] === $sockets['socketID'])
                                                { echo 'selected';}
                                                ?>
                                            value="<?php echo $sockets['socketID'];?>"><?php echo $sockets['socket_name'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                        }
                        ?>  
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break;
            case 'GPU':
                ?>
                    <form class="form" method="post" action="edit/editGPU.php?id=<?php echo $productID;?>" enctype="multipart/form-data">
                        <?php 
                        $query = 'SELECT * FROM GPUs as g
                                  INNER JOIN products as p on g.productID = p.productID
                                  WHERE p.productID = ?;';
                        $data = $connection -> prepare($query);
                        $data -> execute(array($productID));
                        $result = $data -> fetchAll();
                        foreach ($result as $row) {?>
                            Name: <input class="element" type='text' name='name' value='<?php echo $row['name'];?>'><br>
                            Price: <input class="element" type='text' name='price' value='<?php echo $row['price'];?>'><br>
                            Quantity<input class="element" type='text' name='quantity' value='<?php echo $row['quantity'];?>'><br>
                            Model: <input class="element" type='text' name='model' value='<?php echo $row['model'];?>'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer' value='<?php echo $row['manufacturer'];?>'><br>
                            Vendor: <input class="element" type='text' name='vendor' value='<?php echo $row['vendor'];?>'><br>
                            <!-- Picture: <input class="element" type="file" name="fileToUpload" id="fileToUpload"><br> -->
                            Base clock: <input class="element" type='text' step="any" name='base_clock' value='<?php echo $row['base_clock'];?>'><br>
                            Boost clock: <input class="element" type='text' step="any" name='boost_clock' value='<?php echo $row['boost_clock'];?>'><br>
                            Cores: <input class="element" type='text' name='core_count' value='<?php echo $row['core_count'];?>'><br>
                            Series: <input class="element" type='text' name='series' value='<?php echo $row['series'];?>'><br>
                            VRAM: <input class="element" type='text' name='vram' value='<?php echo $row['vram'];?>'><br>
                            VRAM type: <input class="element" type='text' name='vram_type' value='<?php echo $row['vram_type'];?>'><br>
                            Connector type:<input class="element" type='text' name='connector_type' value='<?php echo $row['connector_type'];?>'>
                            <?php
                        }
                        ?>  
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break;
                case 'PSU':
                    ?>
                        <form class="form" method="post" action="edit/editPSU.php?id=<?php echo $productID;?>" enctype="multipart/form-data">
                            <?php 
                            $query = 'SELECT * FROM PSUs as c
                                      INNER JOIN products as p on c.productID = p.productID
                                      INNER JOIN powerratings as pr on c.PowerRatings_ratingID = pr.ratingID
                                      WHERE p.productID = ?;';
                            $data = $connection -> prepare($query);
                            $data -> execute(array($productID));
                            $result = $data -> fetchAll();
                            $query2 = 'SELECT * FROM powerratings';
                            $tmp = $connection -> query($query2);
                            $result2 = $tmp -> fetchAll();
                            foreach ($result as $row) {?>
                                Name: <input class="element" type='text' name='name' value='<?php echo $row['name'];?>'><br>
                                Price: <input class="element" type='number' name='price' value='<?php echo $row['price'];?>'><br>
                                Quantity<input class="element" type='number' name='quantity' value='<?php echo $row['quantity'];?>'><br>
                                Model: <input class="element" type='text' name='model' value='<?php echo $row['model'];?>'><br>
                                Manufacturer: <input class="element" type='text' name='manufacturer' value='<?php echo $row['manufacturer'];?>'><br>
                                Power Rating:<select class="element" name="PowerRatings_ratingID">
                                    <?php
                                    foreach($result2 as $ratings){?>
                                        <option 
                                            <?php 
                                            if($row['PowerRatings_ratingID'] === $ratings['ratingID'])
                                                { echo 'selected';}
                                                ?>
                                            value="<?php echo $ratings['ratingID'];?>"><?php echo $ratings['rating_name'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select><br>
                                wattage: <input class="element" type='number' step="any" name='wattage' value='<?php echo $row['wattage'];?>'><br>
                                type: <select class="element" name="type">
                                    <option <?php if($row['type'] === "Modular") echo 'selected'; ?> value="Modular">Modular</option>
                                    <option <?php if($row['type'] === "Semi-modular") echo 'selected'; ?> value="Semi-modular">Semi-modular</option>
                                    <option <?php if($row['type'] === "Non-modular") echo 'selected'; ?> value="Non-modular">Non-modular</option>
                                </select>
                                <?php
                            }
                            ?>  
                            <input type="submit" value="Save changes">
                        </form>
                    <?php
                    break;
            case 'RAM':
                break;

                
        }

    ?>
    
</body>
</html>