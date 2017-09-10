<?php
session_start();
require('db_connect.php');
foreach($_SESSION['cartProducts'] as $cartProduct){
  $query = "SELECT I.itemID FROM Item as I, Product as P, CartItems as CA WHERE CA.itemID != I.itemID AND P.productID = {$cartProduct} AND P.productID = I.productID Limit {$_SESSION['cart'][$cartProduct]}";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    $query = "UPDATE Item SET status='usable' WHERE itemID = {$row['itemID']}";
    $result = mysqli_query($connection, $query);
  }
}
session_destroy();
?>
