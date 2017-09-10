<div class="checkoutContainer row">
  <div class="stage_1">
    <?php
    if(isset($_SESSION['userinfo']['userID'])){
      $bootstrap = 'col-md-5 col-md-offset-1';
      ?>
      <h2 class='col-md-offset-2 col-md-4'> Favorieten </h2>
      <h2 class='col-md-offset-1 col-md-5'> Winkelmandje </h2>
        <div class="col-md-4 col-md-offset-1 favoritesContainer">
          <?php
          if($getCart = mysqli_prepare($connection, "SELECT productName, productPrice, P.productID FROM Product as P, Favorites as F WHERE F.userID = ? AND F.productID = P.productID")){
            mysqli_stmt_bind_param($getCart, 'i', $_SESSION['userinfo']['userID']);
            mysqli_stmt_execute($getCart);
            printf(mysqli_stmt_error($getCart));
            mysqli_stmt_bind_result($getCart, $productName, $productPrice, $productID);
            while(mysqli_stmt_fetch($getCart)){
              if($getImage = mysqli_prepare($connection2, "SELECT image FROM ProductImages WHERE productID = ? ORDER BY image ASC LIMIT 1")){
                mysqli_stmt_bind_param($getImage, 'i', $productID);
                mysqli_stmt_Execute($getImage);
                mysqli_stmt_bind_result($getImage, $image);
                while(mysqli_stmt_fetch($getImage)){
                  ?>
                  <div class="row">
                    <img class="col-md-4" src="<?=$image?>">
                    <h4  class="col-md-6"><?= $productName?></h4>
                  </div><?php
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
    <div class="<?= $bootstrap?> cartContainer">
      <?php
      if(isset($_SESSION['userinfo']['userID'])){
        if($getCart = mysqli_prepare($connection, "SELECT productName, productPrice, count(I.itemID), P.productID FROM Product as P, Cart as C, Item as I, CartItems as CA WHERE C.cartID = (SELECT cartID FROM Cart WHERE userID = ?) AND C.cartID = CA.cartID AND P.productID = I.productID AND CA.itemID = I.itemID Group BY P.productID")){
          $totalPrice = 0;
          mysqli_stmt_bind_param($getCart, 'i', $_SESSION['userinfo']['userID']);
          mysqli_stmt_execute($getCart);
          // printf(mysqli_stmt_error($getCart));
          $numRows = prepared_num_rows($getCart);
          mysqli_stmt_bind_result($getCart, $productName, $productPrice, $amountOfItems, $productID);
          while(mysqli_stmt_fetch($getCart)){
            if($getImage = mysqli_prepare($connection2, "SELECT image FROM ProductImages WHERE productID = ? ORDER BY image ASC LIMIT 1")){
              mysqli_stmt_bind_param($getImage, 'i', $productID);
              mysqli_stmt_Execute($getImage);
              mysqli_stmt_bind_result($getImage, $image);
              while(mysqli_stmt_fetch($getImage)){
                ?>
                <div class=" cartItem row">
                  <div class="col-md-2 cartAmountOfItems"><h5><b><?=$amountOfItems. " x" ?></b></h5></div>
                  <img class="col-md-4 cartImage" src="<?=$image?>">
                  <div class="col-md-4 cartProductName"><b><h5><?= $productName?></h5></b></div>
                  <div class="cartItemPrice"><h5><b><?php $price = $productPrice * $amountOfItems; echo '&#8364;'.$price; $totalPrice += $price;?></b></h5></div>
                </div><?php
              }
            }
          }
          if($numRows == 0){
            ?>
              <div class="cartInnerItem row" style='border: 1px solid black'>
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
    </div>

  </div>
  <div class="stage_2">
    <div class="container col-md-8">
      <div class='col-md-12 title row'>
        <div class="col-md-2 visible-md visible-lg hidden-sm hidden-xs col-md-offset-1"><button style='' class='goBack'><i class="fa fa-arrow-left" aria-hidden="true"></i></button></div>
        <div class="col-md-9"><h2 class="cartText col-md-8">Winkelmandje</h2></div>
      </div>
      <div class="stage_2Cart row col-md-offset-1 col-md-10">
          <div class="cartInnerItems ">
            <?php
            if(isset($_SESSION['userinfo']['userID'])){
              if($getCart = mysqli_prepare($connection, "SELECT productName, productPrice, count(I.itemID), P.productID FROM Product as P, Cart as C, Item as I, CartItems as CA WHERE C.cartID = (SELECT cartID FROM Cart WHERE userID = ?) AND C.cartID = CA.cartID AND P.productID = I.productID AND CA.itemID = I.itemID Group BY P.productID")){
                $totalPrice = 0;
                mysqli_stmt_bind_param($getCart, 'i', $_SESSION['userinfo']['userID']);
                mysqli_stmt_execute($getCart);
                printf(mysqli_stmt_error($getCart));
                mysqli_stmt_bind_result($getCart, $productName, $productPrice, $amountOfItems, $productID);
                while(mysqli_stmt_fetch($getCart)){
                  if($getImage = mysqli_prepare($connection2, "SELECT image FROM ProductImages WHERE productID = ? ORDER BY image ASC LIMIT 1")){
                    mysqli_stmt_bind_param($getImage, 'i', $productID);
                    mysqli_stmt_Execute($getImage);
                    mysqli_stmt_bind_result($getImage, $image);
                    while(mysqli_stmt_fetch($getImage)){
                      ?>
                      <div class="cartInnerItem">
                        <div class="col-md-2 cartInnerAmountOfItems"><h5><b><?=$amountOfItems. " x" ?></b></h5></div>
                        <img class="col-md-4 cartInnerImage" src="<?=$image?>">
                        <div class="col-md-4 cartInnerProductName"><b><h5><?= $productName?></h5></b></div>
                        <div class="cartInnerItemPrice"><h5><b><?php $price = $productPrice * $amountOfItems; echo '&#8364;'.$price; $totalPrice += $price;?></b></h5></div>
                      </div><?php
                    }
                  }
                }
              }
            }
            else if(isset($_SESSION['cart']) && !isset($_SESSION['userinfo']['userID']) && $_SESSION['cart'] != ""){
              $totalPrice = 0;
              foreach($_SESSION['cartProducts'] as $cartProduct){
                $query = "SELECT p.productName, p.productPrice, PrI.image FROM Product as p, ProductImages as PrI WHERE p.productID = {$cartProduct} AND p.productID = PrI.productID ORDER BY image ASC LIMIT 1";
                $result = mysqli_query($connection, $query);
                foreach($result as $row){
                  ?>
                  <div class="cartInnerItem">
                    <div class="col-md-2 cartInnerAmountOfItems"><h5><b><?= $_SESSION['cart'][$cartProduct]. " x" ?></b></h5></div>
                    <img class="col-md-4 cartInnerImage" src="<?=$row['image']?>">
                    <div class="col-md-4 cartInnerProductName"><b><h5><?= $row['productName']?></h5></b></div>
                    <div class="cartInnerItemPrice"><h5><b><?php $price = $row['productPrice'] * $_SESSION['cart'][$cartProduct]; echo '&#8364;'.$price; $totalPrice += $price;?></b></h5></div>
                  </div><?php
                }
              }
              for($i = 1; $i <= count($_SESSION['cartProducts']); $i++){

              }
            }
            ?>
            </div>
            <div class="cartInnerTotalPrice"><h5><b><?php if(isset($productPrice) && isset($amountOfItems)){$price = $productPrice * $amountOfItems;} echo 'Totale Prijs:</h5><h5> &#8364;'.$totalPrice?></b></h5></div>
            <?php
            ?>
      </div>
      <div class="shipping row">
        <div class="shippingAddress col-md-6">
          <h2 class="">Lever Adres</h2>
          <input class="col-md-9 col-md-offset-2" type="text" placeholder="Naam" id="shippingName" value="Aaron van Leijenhorst">
          <input class="col-md-9 col-md-offset-2" type="email" placeholder="Email" id="shippingEmail" value="aarieaaron2@live.nl">
          <input class="col-md-9 col-md-offset-2" type="text" placeholder ="Straat naam" id="shippingStreet" value="Hazepad 6">
          <input class="col-md-3 col-md-offset-2" type="text" placeholder="Postcode" id="shippingZipcode" value="3766JT">
          <input class="col-md-6" type="text" placeholder="Stad" id="shippingCity" value="Soest">
          <div class="col-md-offset-2 col-md-4">Bewaar voor later <input type="checkbox" id="shippingRemember"></div>
          <div class="col-md-6">Gebruik als factuur adres <input type="checkbox" id="useAsInvoiceAddress"></div>
        </div>
        <div class="invoiceAddress col-md-6">
          <h2 class="">Factuur Adres</h2>
          <input class="col-md-9 col-md-offset-1" type="text" placeholder="Naam" id="invoiceName" value="John van Leijenhorst">
          <input class="col-md-9 col-md-offset-1" type="email" placeholder="Email" id="invoiceEmail" value="aarieaaron2@live.nl">
          <input class="col-md-9 col-md-offset-1" type="text" placeholder ="Straat naam" id="invoiceStreet" value="Industrieweg 37C">
          <input class="col-md-3 col-md-offset-1" type="text" placeholder="Postcode" id="invoiceZipcode" value="3766AA">
          <input class="col-md-6" type="text" placeholder="Stad" id="invoiceCity" value="Soest">
          <div class="col-md-offset-2 col-md-4">Bewaar voor later <input type="checkbox" id="invoiceRemember"></div>
        </div>
      </div>
    </div>
    <div class="paymentCart col-md-3">
      <h2 class="">Betaal methode</h2>
      <?php
        $wireTransfer = false;
        $color = '';
        if(isset($_SESSION['userinfo']['userID'])){
          echo "Bij het registeren heeft u de volgende optie gekozen:";
          if($getPayment = mysqli_prepare($connection, "SELECT paymentMethod, bank FROM User WHERE userID =?")){
            mysqli_stmt_bind_param($getPayment, 'i', $_SESSION['userinfo']['userID']);
            mysqli_stmt_execute($getPayment);
            mysqli_stmt_bind_result($getPayment, $paymentMethod, $bank);
            while(mysqli_stmt_fetch($getPayment)){
              if($paymentMethod == 'ideal'){
                $image = 'images/iDEAL_pink.png';
                $color = 'background-color: #D71281; color: #F0F0F0';
                if($bank != 'ABN_AMRO'){
                  $bank .= ' bank';
                }
                else{
                  $bank = 'ABN AMRO bank';
                }
                echo "<br><h4><b>iDeal</b> bij de <b>".$bank."</b></h4>";
              }
              else if ($paymentMethod == 'paypal'){
                $image = 'images/paypal-checkout-button.png';
                echo "<br><h4><b>Paypal</b></h4>";
              }
              else if ($paymentMethod == 'bank'){
                echo "<br><h4><b>Overmaken</b></h4>";
                $wireTransfer = true;
              }
              else if ($paymentMethod == 'cash'){
                echo "<br><h4><b>Aan de deur betalen</b></h4>";
              }
            }
          }
        }
        if(!isset($_SESSION['userinfo']['userID']) || $wireTransfer == true){
          ?>
          <div class="wireTransfer">
            <h5>Stuur het te betalen bedrag met deze informatie:</h5>
            <div class="wireTransferInformation">
              <div class="wireTransferIBAN">
                <h5 class='wireTransferGroup'>IBAN:</h5>
                <h5>NL74 INGB 0001 0294 10</h5>
              </div>
              <div class="wireTransferRand">
                <h5 class='wireTransferGroup'>Betaal kenmerk:</h5>
                <h5><?php $betaalKenmerk = md5(rand(0, 1000)); echo $betaalKenmerk;?></h5>
              </div>
            </div>
          </div>
          <?php
        }
      ?>
      <div class="row paymentButton">
        <button class="btn col-md-5 col-md-offset-4" style='<?=$color?>'><img style='height: auto; width: 100%' src='<?=$image?>'><br>Betaal</button>
      </div>
    </div>
  </div>
  <div class="stage_3">
  </div>
</div>
<script>
$(".goBack").click(function(){
  $(".stage_2").hide();
  $(".stage_1").show();
  $(".statusText").html("");
});


$(".cartOrderButton").click(function(){
  $(".stage_1").hide();
  $(".statusText").html("U kunt u winkelmandje niet meer aanpassen");
  $(".rightSidebar").children(".cartItems button", ".favoriteItems button").hide();
  $(".stage_2").show();
})

$("#useAsInvoiceAddress").click(function(){
  console.log("clicked");
  if($(this).prop('checked') == true){
    console.log("checked");
    $("#invoiceName").val($("#shippingName").val());
    $("#invoiceName").prop('disabled', true);
    $("#invoiceEmail").val($("#shippingEmail").val());
    $("#invoiceEmail").prop('disabled', true);
    $("#invoiceAddress").val($("#shippingAddress").val());
    $("#invoiceAddress").prop('disabled', true);
    $("#invoiceStreet").val($("#shippingStreet").val());
    $("#invoiceStreet").prop('disabled', true);
    $("#invoiceCity").val($("#shippingCity").val());
    $("#invoiceCity").prop('disabled', true);
    $("#invoiceZipcode").val($("#shippingZipcode").val());
    $("#invoiceZipcode").prop('disabled', true);
  }
  else{
    console.log("unchecked");
    $("#invoiceName").prop('disabled', false);
    $("#invoiceEmail").prop('disabled', false);
    $("#invoiceAddress").prop('disabled', false);
    $("#invoiceCity").prop('disabled', false);
    $("#invoiceStreet").prop('disabled', false);
    $("#invoiceZipcode").prop('disabled', false);
  }
});

$(".paymentButton").click(function(){
  var data = {};
  //Set the action
  data.action = "parseOrder";
  //Sets all the shipping information
  data.shippingStreet = $("#shippingStreet").val();
  data.shippingZipcode = $("#shippingZipcode").val();
  data.shippingCity = $("#shippingCity").val();
  data.shippingName = $("#shippingName").val();
  data.shippingEmail = $("#shippingEmail").val();
  data.shippingSaveForLater = $("#shippingRemember").val();

  //Sets all the invoice information
  data.invoiceStreet = $("#invoiceStreet").val();
  data.invoiceZipcode = $("#invoiceZipcode").val();
  data.invoiceCity = $("#invoiceCity").val();
  data.invoiceName = $("#invoiceName").val();
  data.invoiceEmail = $("#invoiceEmail").val();
  data.invoiceSaveForLater = $("#invoiceRemember").val();

  console.log(data);
  function onComplete(data){
    // $(".stage_2").hide();
    // $(".stage_3").append("<h1>Bedankt voor het bestellen</h1><br><h3>Er is een factuur naar uw email gestuurd.</h3>");
    // $(".stage_3").show();
  }
  parseAjax(data, onComplete);
});
</script>
