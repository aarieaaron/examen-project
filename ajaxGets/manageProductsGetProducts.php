<?php
require('../db_connect.php');
session_start();

$query = "SELECT * FROM Product";
$result = mysqli_query($connection, $query);
echo '<option>Selecteer een product</option>';
foreach($result as $row){
  echo '<option value="'.$row['productID'].'">('.$row['productID'].')<span id="productIDOption">'.$row['productName'].'</span></option>';
}


?>
