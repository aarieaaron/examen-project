<div class="checkoutContainer row">
  <div class="stage_1">
    <?php
    if(isset($_SESSION['userinfo']['userID'])){
      $bootstrap = 'col-md-5 col-md-offset-1';
    }
    else{
      $bootstrap = 'col-md-8 col-md-offset-2';
    }
    ?>
    <div class="favoritesWrapper">
      <!-- Loaded from ajaxGets/getCheckoutFavorites.php -->
    </div>
    <div class="<?= $bootstrap?> cartContainer">
      <!-- Loaded from ajaxGets/getCheckoutCart.php -->
    </div>

  </div>
  <div class="stage_2">
    <div class="container col-md-8">
      <div class='col-md-12 title row'>
        <div class="col-md-2 visible-md visible-lg hidden-sm hidden-xs col-md-offset-1"><button style='' class='goBack'><i class="fa fa-arrow-left" aria-hidden="true"></i></button></div>
        <div class="col-md-9"><h2 class="cartText col-md-8">Winkelmandje</h2></div>
      </div>
      <div class="stage_2Cart row col-md-offset-1 col-md-10">
        <!-- Loaded from ajaxGets/getCheckoutCartStage2.php -->
      </div>
      <div class="shipping row">
        <?php
        if(isset($_SESSION['userinfo']['userID'])){
          $query = "SELECT * FROM ShippingAddress WHERE orderID = (SELECT orderID FROM Orders WHERE email  = '{$_SESSION['userinfo']['email']}' ORDER BY orderID DESC LIMIT 1) AND saveForLater = 1 order by orderID DESC LIMIT 1";
          $result = mysqli_query($connection, $query);
          foreach($result as $row){
            ?>
            <div class="shippingAddress col-md-6">
              <h2 class="">Lever Adres</h2>
              <input class="col-md-9 col-md-offset-2" type="text" placeholder="Naam" id="shippingName" value="<?= $row['name'] ?>">
              <input class="col-md-9 col-md-offset-2" type="email" placeholder="Email" id="shippingEmail" value="<?= $row['email'] ?>">
              <input class="col-md-9 col-md-offset-2" type="text" placeholder ="Straat naam" id="shippingStreet" value="<?= $row['street'] ?>">
              <input class="col-md-3 col-md-offset-2" type="text" placeholder="Postcode" id="shippingZipcode" value="<?= $row['zipcode'] ?>">
              <input class="col-md-6" type="text" placeholder="Stad" id="shippingCity" value="<?= $row['city'] ?>">
              <div class="col-md-offset-2 col-md-4">Bewaar voor later <input type="checkbox" id="shippingRemember"></div>
              <div class="col-md-6">Gebruik als factuur adres <input type="checkbox" id="useAsInvoiceAddress"></div>
            </div>
            <?php
          }
          $query = "SELECT * FROM InvoiceAddress WHERE orderID = (SELECT orderID FROM Orders WHERE email  = '{$_SESSION['userinfo']['email']}' ORDER BY orderID DESC LIMIT 1) AND saveForLater = 1 order by orderID DESC LIMIT 1";
          $result = mysqli_query($connection, $query);
          foreach($result as $row){
            ?>
            <div class="invoiceAddress col-md-6">
              <h2 class="">Factuur Adres</h2>
              <input class="col-md-9 col-md-offset-1" type="text" placeholder="Naam" id="invoiceName" value="<?= $row['name'] ?>">
              <input class="col-md-9 col-md-offset-1" type="email" placeholder="Email" id="invoiceEmail" value="<?= $row['email'] ?>">
              <input class="col-md-9 col-md-offset-1" type="text" placeholder ="Straat naam" id="invoiceStreet" value="<?= $row['street'] ?>">
              <input class="col-md-3 col-md-offset-1" type="text" placeholder="Postcode" id="invoiceZipcode" value="<?= $row['zipcode'] ?>">
              <input class="col-md-6" type="text" placeholder="Stad" id="invoiceCity" value="<?= $row['city'] ?>">
              <div class="col-md-offset-2 col-md-4">Bewaar voor later <input type="checkbox" id="invoiceRemember"></div>
            </div>
            <?php
          }
        }
        else{
          ?>
          <div class="shippingAddress col-md-6">
            <h2 class="">Lever Adres</h2>
            <input class="col-md-9 col-md-offset-2" type="text" placeholder="Naam" id="shippingName" value="">
            <input class="col-md-9 col-md-offset-2" type="email" placeholder="Email" id="shippingEmail" value="">
            <input class="col-md-9 col-md-offset-2" type="text" placeholder ="Straat naam" id="shippingStreet" value="">
            <input class="col-md-3 col-md-offset-2" type="text" placeholder="Postcode" id="shippingZipcode" value="">
            <input class="col-md-6" type="text" placeholder="Stad" id="shippingCity" value="">
            <div class="col-md-offset-2 col-md-4">Bewaar voor later <input type="checkbox" id="shippingRemember"></div>
            <div class="col-md-6">Gebruik als factuur adres <input type="checkbox" id="useAsInvoiceAddress"></div>
          </div>
          <div class="invoiceAddress col-md-6">
            <h2 class="">Factuur Adres</h2>
            <input class="col-md-9 col-md-offset-1" type="text" placeholder="Naam" id="invoiceName" value="">
            <input class="col-md-9 col-md-offset-1" type="email" placeholder="Email" id="invoiceEmail" value="">
            <input class="col-md-9 col-md-offset-1" type="text" placeholder ="Straat naam" id="invoiceStreet" value="">
            <input class="col-md-3 col-md-offset-1" type="text" placeholder="Postcode" id="invoiceZipcode" value="">
            <input class="col-md-6" type="text" placeholder="Stad" id="invoiceCity" value="">
            <div class="col-md-offset-2 col-md-4">Bewaar voor later <input type="checkbox" id="invoiceRemember"></div>
          </div>
          <?php
        }
        ?>
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
$.getScript("functions.js");

$(document).on('click', ".clearCheckoutCart", function(){
  var info = {};
  info.action = "clearCheckoutCart";
  info.productID = $(this).attr('id');
  function onComplete(data){
    $(".cartContainer").load('ajaxGets/getCheckoutCart.php');
    $(".cartItems").load('ajaxGets/getCart.php');
  }
  parseAjax(info, onComplete);
});
$(document).on('click', ".removeFromCheckoutCart", function(){
  var info = {};
  info.action = "removeFromCheckoutCart";
  info.productID = $(this).attr('id');
  function onComplete(data){
    $(".cartContainer").load('ajaxGets/getCheckoutCart.php');
    $(".cartItems").load('ajaxGets/getCart.php');
  }
  parseAjax(info, onComplete);
});
$(document).on('click',".addFromFavoritesToCart",function(){
  var data = {};
  data.action = "addFromFavoritesToCart";
  data.productID = $(this).attr('id');
  function onComplete(data){
    $(".cartContainer").load("ajaxGets/getCheckoutCart.php");
    $(".cartItems").load("ajaxGets/getCart.php", function(){
      countDown($(document).find("#lastModified").val());
    });
  }
  parseAjax(data, onComplete);
});

$(document).on('click',".removeFromFavorites",function(){
  console.log('test');
  var data = {};
  data.action = "removeFromFavorites";
  data.productID = $(this).attr('id');
  function onComplete(data){
    $(".favoriteItems").load("ajaxGets/getFavorites.php");
    $(".favoritesWrapper").load("ajaxGets/getCheckoutFavorites.php");
  }
  parseAjax(data, onComplete);
});


$(".favoritesWrapper").load('ajaxGets/getCheckoutFavorites.php');
$(".cartContainer").load('ajaxGets/getCheckoutCart.php');
$(document).on('click',".changeCart", function(){
  console.log('changed cart 2');
  $(".cartContainer").load('ajaxGets/getCheckoutCart.php');
});
$(".stage_2Cart").load('ajaxGets/getCheckoutCartStage2.php');
$(".goBack").click(function(){
  $(".stage_2").hide();
  $(".stage_1").show();
  $(".statusText").html("");
});


$(document).on('click',".cartOrderButton", function(){
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
  if($("#shippingRemember").prop('checked') == true){data.shippingSaveForLater = true;}else{data.shippingSaveForLater = false;}

  //Sets all the invoice information
  data.invoiceStreet = $("#invoiceStreet").val();
  data.invoiceZipcode = $("#invoiceZipcode").val();
  data.invoiceCity = $("#invoiceCity").val();
  data.invoiceName = $("#invoiceName").val();
  data.invoiceEmail = $("#invoiceEmail").val();
  if($("#invoiceRemember").prop('checked') == true){data.invoiceSaveForLater = true;}else{data.invoiceSaveForLater = false;}

  console.log(data);
  function onComplete(data){
    $(".stage_2").hide();
    $(".stage_3").append("<div style='text-align: center'><h1>Bedankt voor het bestellen</h1><br><h3>Er is een factuur naar uw email gestuurd.</h3></div>");
    $(".stage_3").show();
    $('.cartItems').load('ajaxGets/getCart.php')
  }
  parseAjax(data, onComplete);
});
</script>
