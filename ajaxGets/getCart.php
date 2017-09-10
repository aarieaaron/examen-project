<?php
require("../db_connect.php");
require("../functions.php");
session_start();
//If the user is logged in
if(isset($_SESSION['userinfo']['userID'])){
  $query = "SELECT count(CA.itemID) as Count, sum(P.productPrice) as Sum, C.lastModified FROM CartItems as CA, Cart as C, Item as I, Product as P WHERE C.cartID = CA.cartID AND C.userID = {$_SESSION['userinfo']['userID']} AND P.productID = I.productID AND I.itemID = CA.itemID";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    echo $row['Count']." PRODUCT(EN) IN UW WINKELMANDJE<br>";
    if($row['Count'] != 0){
      echo "Totale Prijs &#8364;".$row['Sum'];
    }
    echo "<input type='hidden' value='".strtotime($row['lastModified'])."' id='lastModified'>";
  }
}
else{
  if(isset($_SESSION['cart'])){
    $totalProducts = 0;
    foreach($_SESSION['cartProducts'] as $cartProducts){
      $totalProducts += $_SESSION['cart'][$cartProducts];
      $query = "SELECT productPrice FROM Product WHERE productID = {$cartProducts}";
      $result = mysqli_query($connection, $query);
      foreach($result as $row){
        $totalPrice += $row['productPrice'] * $_SESSION['cart'][$cartProducts];
      }
    }
    echo $totalProducts." PRODUCT(EN) IN UW WINKELMANDJE<br>";
    if($totalProducts != 0){
      echo "Totale Prijs &#8364;".$totalPrice;
    }
    echo "<input type='hidden' value='".strtotime($_SESSION['cart']['lastModified'])."' id='lastModified'>";
  }
}
?>
<script>
// console.log($("#lastModified").val());
</script>
