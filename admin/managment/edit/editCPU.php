<form method="post" action="update_cpu.php">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Speed</th>
        <th>Cores</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include_once("../../../php/staticInfo.php");
        $connection = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
        $query = 'SELECT * FROM CPU WHERE productID = ?';
        $data = $connection -> prepare($query);
        $data -> execute(array($productID));
        $result = $data -> fetchAll();
        
        // Loop through each row and display the data in input fields
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td><input type='text' name='brand[]' value='" . $row['brand'] . "'></td>";
          echo "<td><input type='text' name='model[]' value='" . $row['model'] . "'></td>";
          echo "<td><input type='text' name='speed[]' value='" . $row['speed'] . "'></td>";
          echo "<td><input type='text' name='cores[]' value='" . $row['cores'] . "'></td>";
          echo "<td><input type='text' name='price[]' value='" . $row['price'] . "'></td>";
          echo "</tr>";
        }
        // Close the database connection
        mysqli_close($conn);
      ?>
    </tbody>
  </table>
  
  <input type="submit" value="Save changes">
</form>