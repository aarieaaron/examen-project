<?php
require('../db_connect.php');
session_start();

$query = "SELECT * FROM Brands";
$result = mysqli_query($connection, $query);
echo '<option>Selecteer een merk</option>';
foreach($result as $row){
  echo '<option value="'.$row['brandName'].'"><span id="productIDOption">'.$row['brandName'].'</span></option>';
}


?>
