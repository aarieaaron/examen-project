<?php
if(isset($_GET['id'])){
  $product = $_GET['id'];
  $t = microtime(true);
  date_default_timezone_set("Europe/Amsterdam");
  $micro = sprintf("%06d",($t - floor($t)) * 1000000);
  $timeBefore = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );

  // print $timeBefore->format("Y-m-d H:i:s.u"); // note at point on "u"
  if($productInfo = mysqli_prepare($connection, "SELECT `productName`, `productBrand`, `productPrice`, `productDescription` FROM Product WHERE productID = ?")){

    mysqli_stmt_bind_param($productInfo, 'i', $product);
    mysqli_stmt_execute($productInfo);
    mysqli_stmt_bind_result($productInfo, $productName, $productBrand, $productPrice, $productDescription);

    while (mysqli_stmt_fetch($productInfo)) {
      ?>
      <div class="container row col-md-12">
        <div class="productImages col-md-6">
          <img id="mainImage" src="images/no_image_available.png" class="col-md-12 row">
          <div class="secondaryImages row col-md-12">
            <div class="secondaryImagesInner">
            <?php
            if($getImages = mysqli_prepare($connection2, "SELECT image FROM ProductImages WHERE productID = ?")){
              mysqli_stmt_bind_param($getImages, 'i', $product);
              mysqli_stmt_execute($getImages);
              // printf("Error: %s.\n", mysqli_stmt_error($getImages));
              mysqli_stmt_bind_result($getImages, $image);
              $imageNumber = 1;
              while(mysqli_stmt_fetch($getImages)){
                ?><img id='smallImage_<?= $imageNumber ?>' class="smallImages" name="smallImages" src='<?= $image ?>'>  <?php
                ++$imageNumber;
              }
            }
            ?>
            </div>
          </div>
        </div>
        <div class="productInformation col-md-6">
          <?php
            $date = date('Y-m-d');
            $query = "SELECT * FROM ProductSale WHERE date = '{$date}'";
            $result = mysqli_query($connection2, $query) or die(mysqli_error($connection2));
            foreach($result as $row){
              $current_time = date('H:i a');
              $sunrise = "9:00 am";
              $sunset = "11:00 am";
              $date1 = DateTime::createFromFormat('H:i a', $current_time);
              $date2 = DateTime::createFromFormat('H:i a', $sunrise);
              $date3 = DateTime::createFromFormat('H:i a', $sunset);
              if ($date1 > $date2 && $date1 < $date3)
              {
                if($row['productID'] == $_GET['id']){
                  $productPrice = '<strike>&#8364;'.$productPrice.'</strike> NU VOOR &#8364;'.($productPrice / 2);
                }
              }
              else{
                $productPrice = '&#8364;'.$productPrice;
              }
            }
          ?>
          <h4><b><i><?= $productBrand ?></i></b><i> <?= $productName ?> </i> | <b><?= $productPrice ?> </b></h4>
          <span id="productDescription"><?= $productDescription ?></span>
          <table class="productAttributes">
            <?php
            if($getAttributes = mysqli_prepare($connection2, "SELECT attribute, attributeValue FROM ProductAttributes WHERE productID = ?")){
              mysqli_stmt_bind_param($getAttributes, 'i', $product);
              mysqli_stmt_execute($getAttributes);
              // printf("Error: %s.\n", mysqli_stmt_error($getImages));
              mysqli_stmt_bind_result($getAttributes, $attribute, $attributeValue);
              $attributeNumber = 1;
              while(mysqli_stmt_fetch($getAttributes)){
                ?><tr><p id="productAttributes"><td><h5><b id="attribute_<?=$attributeNumber?>"><?= $attribute ?></b></h5></td> <td><h5><i id="attributeValue_<?=$attributeNumber?>"><?= $attributeValue ?></i></h5></td><p></tr>  <?php
                ++$attributeNumber;
              }
            }
            $t = microtime(true);
            date_default_timezone_set("Europe/Amsterdam");
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $timeAfter = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            ?>
          </table>
        </div>
      </div>
      <div class="container col-md-12 row">
        <div class='orderButtonWrapper'>
        </div>

          <div class="form-group" style="margin: 0px; padding: 0px">
            <?php
            if(isset($_SESSION['userinfo']['userID'])){
              if($getFavoritesInner = mysqli_prepare($connection2, "SELECT userID, productID FROM Favorites WHERE userID = ? AND productID = ?")){
                mysqli_stmt_bind_param($getFavoritesInner, 'ii', $_SESSION['userinfo']['userID'], $_GET['id']);
                mysqli_stmt_execute($getFavoritesInner);
                // printf("Error: %s.\n", mysqli_stmt_error($getFavoritesInner));
                $inFavorites = prepared_num_rows($getFavoritesInner);
                if($inFavorites == 0){
                  $buttonText = "<b>Voeg toe aan favorieten</b><img src='images/star.png' style='height: 34px; width: auto'>";
                }
                else{
                  $buttonText = "<b>Verwijder uit favorieten</b><img src='images/star.png' style='height: 34px; width: auto'>";
                }
              }
            ?>
            <button style="margin: 0px;" class="addToFavorites" style="width: 175px;"><?= $buttonText ?></button>
            <?php
          }?>
          </div>
      </div>
      <?php
    }
  }
  // print $timeBefore->format("Y-m-d H:i:s.u")."<br>"; // note at point on "u"
  // print $timeAfter->format("Y-m-d H:i:s.u"); // note at point on "u"
}
else{
  echo "invalid product";
}
?>
<script>
$.getScript("functions.js");
$(document).ready(function(){
  var info = {};
  info.product = '<?= $_GET['id'] ?>';
  function onComplete(data){
    $(".orderButtonWrapper").html(data.responseText);
    if($(".productCount").html() == 0){
      $(".amountOfItems").val(0);
    }else{
      $(".amountOfItems").val(1);
    }
  }
  $(document).on('keyup', ".amountOfItems", function(){
    var productCount = parseInt($(".productCount").html());
    var value = $(this).val();
    console.log(productCount);
      console.log(value);
    if(value >= productCount){
      console.log(productCount);
      console.log(value);
      $(this).val(productCount);
    }
  });
  parseAjaxReturn(info, onComplete, 'ajaxGets/getProductCount.php');
  //Checks if there are any images.
  if($(".smallImages").length > 0){
    $("#mainImage").attr("src", $("#smallImage_1").attr('src'));                          //Sets the main image src to be equal to the src of the first image loaded.
  }
  else{
    $("#mainImage").attr("src", "images/no_image_available.png");                         //Sets the main image src to the default image.
  }

  //Set the width of the secondaryImagesInner element to allow for a vertical scroll image gallery.

  var secondaryImagesInnerWidth = 0;                                                      //Sets the variable that will later be added to.
  //Starts looping through all of the smaller images
  for(var i = 1; i <= $(".smallImages").length; i++){
    var imageWidth = parseInt($("#smallImage_" + i + "").css("width").slice(0, -2)) + 4;  //Parse image width into a float.
    secondaryImagesInnerWidth = secondaryImagesInnerWidth + imageWidth;                   //Add image width to the sum.
    $(".secondaryImagesInner").css({"width": secondaryImagesInnerWidth});                 //Sets .secondaryImagesInner width.

    //Checks if the sum of image widths is more than the secondaryImages container.
    if($(".secondaryImagesInner").css("width") > $(".secondaryImages").css("width")){
      $(".secondaryImages").css({"height": '80px'});                                      //Sets .secondaryImages width.
    }
  }
  //Change main image to whichever smaller image you mouse over.
  $("img").hover(function(){
    if($(this).hasClass("smallImages")){
      var source = $(this).attr('src');                                                   //Sets the 'source' variable to be the attribute of whatever image is hovered over.
      $("#mainImage").attr("src", source);                                                //Sets the main image src attribute to be equal to the 'source' variable.
    }
  });

  //On the click of the .orderButton add item(s) to cart
  $(document).on('click', '.orderButton',function(){
    var $_GET = <?php echo json_encode($_GET); ?>;                                        //Get the php $_GET variable. A very crude method but works the best.
    var $_SESSION = <?php echo json_encode($_SESSION) ?>;                                 //Trying to get the session variables using the same method as above.

    var data = {};                                                                        //Create an empty data object.
    data.amountOfItems = $(".amountOfItems").val();                                       //Set data.amountOfItems to be equal to the .amountOfItems element.
    data.action = "addToCart";                                                            //Set the data.action to 'addToCart'
    data.productID = $_GET['id'];                                                         //Set the data.productID to whatever the $_GET variable above returns when given the 'id' argument.
    data.userID = $_SESSION['userinfo']['userID'];
    console.log(data.userID);
    function onComplete(data){
      //Hide it's grandparents children (the submit button and the .amountOfItems element).
      $(this).parent().parent().children().hide();
      $(".cartItems").load("ajaxGets/getCart.php", function(){
        countDown($(document).find("#lastModified").val());
      });
        var info = {};
        info.product = '<?= $_GET['id'] ?>';
        function onComplete2(data){
          $(".orderButtonWrapper").html(data.responseText);
        }
        parseAjaxReturn(info, onComplete2, 'ajaxGets/getProductCount.php');
    }
    parseAjax(data, onComplete);                                                          //Call the parseAjax() function
  });
  $(document).on('click', ".addToFavorites", function(){
    console.log('test');
    var $_GET = <?php echo json_encode($_GET); ?>;                                        //Get the php $_GET variable. A very crude method but works the best.
    var $_SESSION = <?php echo json_encode($_SESSION) ?>;                                 //Trying to get the session variables using the same method as above.

    var data = {};                                                                        //Create an empty data object.
    data.action = "addToFavorites";                                                       //Set the data.action to 'addToCart'
    data.productID = $_GET['id'];                                                         //Set the data.productID to whatever the $_GET variable above returns when given the 'id' argument.
    data.userID = $_SESSION['userinfo']['userID'];
    console.log(data.userID);
    function onComplete(data){
      //Change the text within the button
      $(".addToFavorites").html(data.responseText);
      $(".favoriteItems").load("ajaxGets/getFavorites.php");
    }
    parseAjax(data, onComplete);
  });
});
</script>
