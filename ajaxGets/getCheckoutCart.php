<?php
require('../db_connect.php');
require('../functions.php');
session_start();
if(isset($_SESSION['userinfo']['userID'])){
  if($getCart = mysqli_prepare($connection, "SELECT productName, productPrice, count(I.itemID), P.productID FROM Product as P, Cart as C, Item as I, CartItems as CA WHERE C.cartID = (SELECT cartID FROM Cart WHERE userID = ?) AND C.cartID = CA.cartID AND P.productID = I.productID AND CA.itemID = I.itemID Group BY P.productID")){
    $totalPrice = 0;
    mysqli_stmt_bind_param($getCart, 'i', $_SESSION['userinfo']['userID']);
    mysqli_stmt_execute($getCart);
    printf(mysqli_stmt_error($getCart));
    $numRows = prepared_num_rows($getCart);
    mysqli_stmt_bind_result($getCart, $productName, $productPrice, $amountOfItems, $productID);
    while(mysqli_stmt_fetch($getCart)){
      if($getImage = mysqli_prepare($connection2, "SELECT image FROM ProductImages WHERE productID = ? ORDER BY image ASC LIMIT 1")){
        mysqli_stmt_bind_param($getImage, 'i', $productID);
        mysqli_stmt_Execute($getImage);

        mysqli_stmt_bind_result($getImage, $image);
        while(mysqli_stmt_fetch($getImage)){
          $query = "SELECT count(P.productID) as counter, PS.productID FROM Product as P, ProductSale as PS, Cart as C, CartItems as CI, Item as I WHERE
          PS.productID != P.productID AND C.cartID = CI.cartID AND CI.itemID = I.itemID AND I.productID = P.productID AND C.userID = '{$_SESSION['userinfo']['userID']}'";
          $result = mysqli_query($connection, $query);
          $givenMessage = false;
          foreach($result as $row){
            $counter == $row['counter'];
            if($row['counter'] >= 2){
              ?>
              <script>
                $(".warning").html("");
              </script>
              <?php
              if($productID = $row['productID']){
                $current_time = date('H:i a');
                $sunrise = "9:00 am";
                $sunset = "11:00 am";
                $date1 = DateTime::createFromFormat('H:i a', $current_time);
                $date2 = DateTime::createFromFormat('H:i a', $sunrise);
                $date3 = DateTime::createFromFormat('H:i a', $sunset);
                if ($date1 > $date2 && $date1 < $date3)
                {
                  if($row['productID'] == $productID){
                    $productPrice = $productPrice / 2;;
                  }
                }
                else{
                  $productPrice = $productPrice;
                }

              }
            }
            else{
            }
          }
          ?>
          <div class="cartItem row">
            <div class="col-md-2 cartButtons">
              <button class="clearCheckoutCart changeCart" id='<?=$productID?>'><i class="fa fa-times" aria-hidden="true"></i></button>
              <button class="removeFromCheckoutCart changeCart" id='<?=$productID?>'><i class="fa fa-minus" aria-hidden="true"></i></button>
            </div>
            <div class="col-md-2 cartAmountOfItems"><h5><b><?=$amountOfItems. " x" ?></b></h5></div>
            <div class="col-md-6 cartProductName"><b><h5><?= $productName?></h5></b></div>
            <div class="cartItemPrice"><h5><b><?php $price = $productPrice * $amountOfItems; echo '&#8364;'.$price; $totalPrice += $price;?></b></h5></div>
          </div><?php
        }
      }
    }
    if($numRows == 0){
      ?>
        <div class="cartItem row" style='border: 1px solid black'>
          <h3 class="col-md-12" style="color: #888;">U winkelmandje is leeg</h3>
        </div>
      <?php
    }
    ?>
    <div class="row totalPrice">
      <button class="cartOrderButton col-md-3 btn btn-primary">Bestel</button>
      <div class="col-md-5"><b><h5> Totale Prijs: </h5></b></div>
      <div class="col-md-4 cartTotalPrice"><h5><b><?php echo '&#8364;'.$totalPrice?></b></h5></div>
    </div>
    <?php
  }

    if($counter <= 2){
      echo '<p style="color: red" class="warning">WAARSCHUWING: ZONDER 2 EXTRA PRODUCTEN KRIJGT U GEEN KORTING</p>';
    }
}
if(!isset($_SESSION['userinfo']['userID'])){
  $totalPrice = 0;
  if($_SESSION['cart'] != ""){
    foreach($_SESSION['cartProducts'] as $cartProduct){
      $query = "SELECT p.productName, p.productPrice, PrI.image FROM Product as p, ProductImages as PrI WHERE p.productID = {$cartProduct} AND p.productID = PrI.productID ORDER BY image ASC LIMIT 1";
      $result = mysqli_query($connection, $query);
      foreach($result as $row){
        ?>
        <div class=" cartItem row">
          <div class="col-md-2 cartAmountOfItems"><h5><b><?= $_SESSION['cart'][$cartProduct]. " x" ?></b></h5></div>
          <img class="col-md-4 cartImage" src="<?=$row['image']?>">
          <div class="col-md-4 cartProductName"><b><h5><?= $row['productName']?></h5></b></div>
          <div class="cartItemPrice"><h5><b><?php $price = $row['productPrice'] * $_SESSION['cart'][$cartProduct]; echo '&#8364;'.$price; $totalPrice += $price;?></b></h5></div>
        </div><?php
      }
    }
  }
  if($_SESSION['cart'] == ""){
    ?>
      <div class="cartInnerItem row" style='border: 1px solid black'>
        <h3 class="col-md-12" style="color: #888;">U winkelmandje is leeg</h3>
      </div>
    <?php
  }
  ?>
  <div class="row totalPrice">
    <button class="cartOrderButton col-md-3 btn btn-primary">Bestel</button>
    <div class="col-md-5"><b><h5> Totale Prijs: </h5></b></div>
    <div class="col-md-4 cartTotalPrice"><h5><b><?php echo '&#8364;'.$totalPrice?></b></h5></div>
  </div>
  <?php
}
?>
