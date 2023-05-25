<?php
    include_once("../../php/staticInfo.php");
    $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
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
                    <form class="form" method="post" action="add/addCPU.php" enctype="multipart/form-data">
                        <?php 
                        $query2 = 'SELECT * FROM sockets';
                        $tmp = $connection -> query($query2);
                        $result2 = $tmp -> fetchAll();?>
                            Name: <input class="element" type='text' name='name'><br>
                            Price: <input class="element" type='number' name='price'><br>
                            Quantity<input class="element" type='number' name='quantity'><br>
                            Model: <input class="element" type='text' name='model'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                            Base clock: <input class="element" type='number' step="any" name='base_clock'><br>
                            Boost clock: <input class="element" type='number' step="any" name='boost_clock'><br>
                            Cores: <input class="element" type='number' name='core_count'><br>
                            Threads: <input class="element" type='number' name='thread_count'><br>
                            Series: <input class="element" type='text' name='series'><br>
                            Socket:<select class="element" name="socketID">
                                    <?php
                                    foreach($result2 as $sockets){?>
                                        <option value="<?php echo $sockets['socketID'];?>"><?php echo $sockets['socket_name'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                        Picture: <input type="file" name="picture" id="picture">
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break;
            case 'GPU':
                ?>
                    <form class="form" method="post" action="add/addGPU.php" enctype="multipart/form-data">                        
                            Name: <input class="element" type='text' name='name'><br>
                            Price: <input class="element" type='text' name='price'><br>
                            Quantity<input class="element" type='text' name='quantity'><br>
                            Model: <input class="element" type='text' name='model'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                            Vendor: <input class="element" type='text' name='vendor'><br>
                            <!-- Picture: <input class="element" type="file" name="fileToUpload" id="fileToUpload"><br> -->
                            Base clock: <input class="element" type='text' step="any" name='base_clock'><br>
                            Boost clock: <input class="element" type='text' step="any" name='boost_clock'><br>
                            Cores: <input class="element" type='text' name='core_count'><br>
                            Series: <input class="element" type='text' name='series'><br>
                            VRAM: <input class="element" type='text' name='vram'><br>
                            VRAM type: <input class="element" type='text' name='vram_type'><br>
                            Connector type:<input class="element" type='text' name='connector_type'><br>
                            Picture: <input type="file" name="picture" id="picture">
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break; 
            case 'RAM':
                ?>
                    <form class="form" method="post" action="add/addRAM.php" enctype="multipart/form-data">                        
                            Name: <input class="element" type='text' name='name'><br>
                            Price: <input class="element" type='text' name='price'><br>
                            Quantity<input class="element" type='text' name='quantity'><br>
                            Model: <input class="element" type='text' name='model'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                            Frequency: <input class="element" type='number' name='frequency'><br>
                            Latency(CL): <input class="element" type='number' name='latency'><br>
                            type: <select class="element" name="type">
                                <option value="DDR3">DDR3</option>
                                <option value="DDR4">DDR4</option>
                                <option value="DDR5">DDR5</option>
                            </select> 
                            Picture: <input type="file" name="picture" id="picture">
                        <input type="submit" value="Save changes">
                    </form>
                    <?php
                break;
            case 'PSU':
                    ?>
                        <form class="form" method="post" action="add/addPSU.php" enctype="multipart/form-data">
                            <?php 
                            $query2 = 'SELECT * FROM powerratings';
                            $tmp = $connection -> query($query2);
                            $result2 = $tmp -> fetchAll();
                            ?>
                                Name: <input class="element" type='text' name='name'><br>
                                Price: <input class="element" type='number' name='price'><br>
                                Quantity<input class="element" type='number' name='quantity'><br>
                                Model: <input class="element" type='text' name='model'><br>
                                Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                                Power Rating:<select class="element" name="PowerRatings_ratingID">
                                    <?php
                                    foreach($result2 as $ratings){?>
                                        <option value="<?php echo $ratings['ratingID'];?>"><?php echo $ratings['rating_name'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select><br>
                                wattage: <input class="element" type='number' step="any" name='wattage' value='<?php echo $row['wattage'];?>'><br>
                                type: <select class="element" name="type">
                                    <option value="Modular">Modular</option>
                                    <option value="Semi-modular">Semi-modular</option>
                                    <option value="Non-modular">Non-modular</option>
                                </select> <br>
                                Picture: <input type="file" name="picture" id="picture">
                            <input type="submit" value="Save changes">
                        </form>
                    <?php
                break;
            case 'MOBO':
                ?>
                    <form class="form" method="post" action="add/addPSU.php" enctype="multipart/form-data">
                            Name: <input class="element" type='text' name='name'><br>
                            Price: <input class="element" type='number' name='price'><br>
                            Quantity<input class="element" type='number' name='quantity'><br>
                            Model: <input class="element" type='text' name='model'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                            Power Rating:<select class="element" name="PowerRatings_ratingID">
                                <?php
                                foreach($result2 as $ratings){?>
                                    <option value="<?php echo $ratings['ratingID'];?>"><?php echo $ratings['rating_name'];?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                            wattage: <input class="element" type='number' step="any" name='wattage' value='<?php echo $row['wattage'];?>'><br>
                            type: <select class="element" name="type">
                                <option value="Modular">Modular</option>
                                <option value="Semi-modular">Semi-modular</option>
                                <option value="Non-modular">Non-modular</option>
                            </select> 
                            Picture: <input type="file" name="picture" id="picture">
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break;
            case 'Cooling':
                ?>
                    <form class="form" method="post" action="add/addPSU.php" enctype="multipart/form-data">
                            Name: <input class="element" type='text' name='name'><br>
                            Price: <input class="element" type='number' name='price'><br>
                            Quantity<input class="element" type='number' name='quantity'><br>
                            Model: <input class="element" type='text' name='model'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                            Power Rating:<select class="element" name="PowerRatings_ratingID">
                                <?php
                                foreach($result2 as $ratings){?>
                                    <option value="<?php echo $ratings['ratingID'];?>"><?php echo $ratings['rating_name'];?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                            wattage: <input class="element" type='number' step="any" name='wattage' value='<?php echo $row['wattage'];?>'><br>
                            type: <select class="element" name="type">
                                <option value="Modular">Modular</option>
                                <option value="Semi-modular">Semi-modular</option>
                                <option value="Non-modular">Non-modular</option>
                            </select> 
                            Picture: <input type="file" name="picture" id="picture">
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break;
            case 'Storage':
                ?>
                    <form class="form" method="post" action="add/addStorage.php" enctype="multipart/form-data">
                            Name: <input class="element" type='text' name='name'><br>
                            Price: <input class="element" type='number' name='price'><br>
                            Quantity<input class="element" type='number' name='quantity'><br>
                            Model: <input class="element" type='text' name='model'><br>
                            Manufacturer: <input class="element" type='text' name='manufacturer'><br>
                            Capacity: <input type="number" class="element" name="capacity"><br>
                            Write speed: <input type="number" class="element" name="writeSpeed"><br>
                            Read speed: <input type="number" class="element" name="readSpeed"><br>
                            Dram Cache: <input type="number" class="element" name="dramCache"><br>
                            Type: <select class="element" name="type">
                                <option value="HDD">HDD</option>
                                <option value="SSD">SSD</option>
                                <option value="NVMe SSD">NVMe SSD</option>
                            </select> <br>
                            Picture: <input type="file" name="picture" id="picture">
                        <input type="submit" value="Save changes">
                    </form>
                <?php
                break;

                
        }

    ?>
    
</body>
</html>