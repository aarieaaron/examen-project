<?php
require('../db_connect.php');
require('../functions.php');
session_start();
if(isset($_SESSION['userinfo']['userID'])){
  $bootstrap = 'col-md-5 col-md-offset-1';
  ?>
  <h2 class='col-md-offset-2 col-md-4'> Favorieten </h2>
  <h2 class='col-md-offset-1 col-md-5'> Winkelmandje </h2>
    <div class="col-md-4 col-md-offset-1 favoritesContainer">
      <?php
      if($getFavorites = mysqli_prepare($connection, "SELECT productID from Favorites WHERE userID = ?")){
        mysqli_stmt_bind_param($getFavorites, 'i', $_SESSION['userinfo']['userID']);
        mysqli_stmt_execute($getFavorites);
        mysqli_stmt_bind_result($getFavorites, $productID);
        while(mysqli_stmt_fetch($getFavorites)){
          if($getProducts = mysqli_prepare($connection2, "SELECT P.productName, P.productPrice FROM Product as P where P.productID = ?")){
            mysqli_stmt_bind_param($getProducts, 'i', $productID);
            mysqli_stmt_execute($getProducts);
            mysqli_stmt_bind_result($getProducts, $productName, $productPrice);
            while(mysqli_stmt_fetch($getProducts)){
              if($getProductCount = mysqli_prepare($connection3, "SELECT count(itemID) FROM Item WHERE productID = ? AND status = 'usable'")){
                mysqli_stmt_bind_param($getProductCount, 'i', $productID);
                mysqli_stmt_execute($getProductCount);
                mysqli_stmt_bind_result($getProductCount, $productCount);
                while(mysqli_stmt_fetch($getProductCount)){
                  if($productCount > 0){
                    $style = "";
                    $disabled = "";
                  }
                  else{
                    $style = "color: red;";
                    $disabled = "disabled='disabled'";
                  }
                }
              }
              ?>
              <div class="row">
                <p id='favoriteItem' class="col-md-8" style="<?=$style?>"> <?= $productName . " | &#8364;" . roundedNumbers($productPrice)  ?> </p>
                <button class="removeFromFavorites col-md-offset-1 col-md-1" id='<?=$productID?>'><i class="fa fa-times" aria-hidden="true"></i></button>
                <button class="addFromFavoritesToCart col-md-1 changeCart" id='<?=$productID?>'<?=$disabled?>><i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>
              <?php
            }
          }
        }
      }
      ?>
      <p class="row"> * producten in rood zijn tijdelijk niet leverbaar</p>
    </div>
  <?php
}
else{
  $bootstrap = 'col-md-8 col-md-offset-2';
  echo "<h2 style='text-align: center'> Winkelmandje </h2>";
}
 ?>
