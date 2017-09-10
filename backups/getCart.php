<?php
require("../db_connect.php");
require("../functions.php");
session_start();
//If the user is logged in
if(isset($_SESSION['userinfo']['userID'])){
  if($getCart = mysqli_prepare($connection, "SELECT cartID, lastModified from Cart where userID = ? ORDER BY cartID DESC LIMIT 1")){
    mysqli_stmt_bind_param($getCart, 'i', $_SESSION['userinfo']['userID']);
    mysqli_stmt_execute($getCart);
    mysqli_stmt_bind_result($getCart, $cartID, $lastModified);
    $numRows = prepared_num_rows($getCart);
    while(mysqli_stmt_fetch($getCart)){
      echo "<input type='hidden' value='".strtotime($lastModified)."' id='lastModified'>";
    }
    if(!isset($numRows) || $numRows == 0){
    }
    else{
      $totalPrice = 0;
      if($getProducts = mysqli_prepare($connection, "SELECT count(P.productID), productName, productPrice FROM Cart as C, CartItems as CA, Product as P, Item as I WHERE C.userID = ? AND C.cartID = CA.cartID AND CA.itemID = I.itemID AND I.productID = P.productID GROUP BY productName")){
        mysqli_stmt_bind_param($getProducts, 'i', $_SESSION['userinfo']['userID']);
        mysqli_stmt_execute($getProducts);
        printf("\n", mysqli_stmt_error($getProducts));
        mysqli_stmt_bind_result($getProducts, $productCount, $productName, $productPrice);
        while(mysqli_stmt_fetch($getProducts)){
        ?><p id='cartItem'> <?= $productCount."x | " . $productName . " | &#8364;" . roundedNumbers($productPrice)  ?> </p> <?php
          $totalPrice += $productPrice * $productCount;
        }
        echo "<p id='totalPriceOutput'>totale prijs: &#8364;". roundedNumbers($totalPrice)."</p>";
        // echo "<h5><p id='timeRemaining'> </p></h5>";
      }
    }
  }
}
else{
  if(isset($_SESSION['cart']) && $_SESSION['cart'] != ""){
    for($i = 0; $i <= count($_SESSION['cartProducts']); $i++){
      $query = "SELECT * FROM Product WHERE productID = ".$_SESSION['cartProducts'][$i]."";
      $result = mysqli_query($connection, $query);
      foreach($result as $row){
        ?><p id='cartItem'> <?= $_SESSION['cart'][$_SESSION['cartProducts'][$i]]."x | " . $row['productName'] . " | &#8364;" . roundedNumbers($row['productPrice'])  ?> </p> <?php
          $totalPrice += $row['productPrice'] * $_SESSION['cart'][$_SESSION['cartProducts'][$i]];
          echo "<input type='hidden' value='".strtotime($_SESSION['cart']['lastModified'])."' id='lastModified'>";
      }
    }
    echo "<p id='totalPriceOutput'>totale prijs: &#8364;". roundedNumbers($totalPrice)."</p>";
  }
  else{
    echo "<p> Uw winkelmandje is leeg </p>";
  }
}
?>
<script>
// console.log($("#lastModified").val());
</script>
