<?php
require("functions.php");
require_once('dompdf-master/autoload.inc.php');
require("db_connect.php");
session_start();
if(isset($_POST['action'])){
  switch($_POST['action']){
    case "login":
      $password = md5($_POST['wachtwoord']);
      $email = $_POST['email'];
      if(checkPassword($password, $email)){
        echo "Login successvol, uw word geredirect.";
      }else{
        echo "Uw email of wachtwoord was incorrect, probeer het opnieuw.";
      }
    break;
    case "register":
      $name = $_POST['firstname']." ".$_POST['lastname'];
      $email = $_POST['email'];
      $payment = $_POST['payment'];
      if($payment == 'ideal'){
        $bank = $_POST['iDeal'];
      }
      else{
        $bank = null;
      }
      if($checkForEmail = mysqli_prepare($connection, 'SELECT * FROM User WHERE email = ?')){
        mysqli_stmt_bind_param($checkForEmail, 's', $_POST['email']);
        mysqli_execute($checkForEmail);
        $numRows = prepared_num_rows($checkForEmail);
        if($numRows > 0){
          echo "Dit email adres bestaat al ". $numRows;
          break;
        }
      }
      if($createUser = mysqli_prepare($connection, "INSERT INTO `User`(`userID`, `name`, `email`, `paymentMethod`, `bank`) VALUES (null,?,?,?,?)")){
        mysqli_stmt_bind_param($createUser, "ssss", $name, $email, $payment, $bank);
        mysqli_stmt_execute($createUser);
        if($createUserPassword = mysqli_prepare($connection, "INSERT INTO `UserSecurity`(`userID`, `passwordHash`, `verificationHash`) VALUES ((SELECT UserID from User where email = ?),?,MD5((SELECT UserID from User where email = ?)))")){
          mysqli_stmt_bind_param($createUserPassword, "sss", $email, md5($_POST['wachtwoord']), $email);
          mysqli_stmt_execute($createUserPassword);
          if($createUserRoles = mysqli_prepare($connection, "INSERT INTO `UserRoles`(`userID`, `role`) VALUES ((SELECT UserID from User where email = ?), 'user')")){
            mysqli_stmt_bind_param($createUserRoles, "s", $email);
            mysqli_stmt_execute($createUserRoles);
            if($getActivationHash = mysqli_prepare($connection, "SELECT verificationHash FROM UserSecurity as US, User as U WHERE U.userID = US.userID AND U.email = ?")){
              mysqli_stmt_bind_param($getActivationHash, "s", $email);
              mysqli_stmt_execute($getActivationHash);

              /* bind result variables */
              mysqli_stmt_bind_result($getActivationHash, $hash);

              /* fetch values */
              while (mysqli_stmt_fetch($getActivationHash)) {
                $to = 'aarieaaron2@live.nl';
                $subject = "Welkom bij examen.aaronvanleijenhorst.xyz";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // More headers
                $headers .= 'From: <noreply@examen.aaronvanleijenhorst.xyz>' . "\r\n";
                $message = "
                <table>
                  Beste klant,<br>
                  <br>
                  Bedankt voor het winkelen mij examen.aaronvanleijenhorst.xyz.<br>
                  Hieronder staat een link waar u uw account kan activeren.<br>
                  <a href='http://examen.aaronvanleijenhorst.xyz/index.php?content=activate&hash={$hash}&email={$email}'> examen.aaronvanleijenhorst.xyz/activeren</a><br>
                  <br>
                  Met vriendelijke groet, <br>
                  examen.aaronvanleijenhorst.xyz.
                </table>
                ";
                if(mail($to,$subject,$message,$headers)){
                  echo "U heeft zich geregistreerd, we hebben u een email met een verificatie link gestuurd.";
                }
                else{
                  echo "Er was een probleem met het versturen van de verificatie email, neem alstublieft contact op met een beheerder.";
                }
              }
            }
            else{
              echo "Er was een probleem, neem alstublieft contact op met een beheerder. Error code 4";
            }
          }
          else{
            echo "Er was een probleem, neem alstublieft contact op met een beheerder. Error code 3";
          }
        }
        else{
          echo "Er was een probleem, neem alstublieft contact op met een beheerder. Error code 2";
        }
      }
      else{
        echo "Er was een probleem, neem alstublieft contact op met een beheerder. Error code 1";
      }
    break;
    case "addProduct":
      $imageNumber = $_POST['maxImage'];
      //Add images to array
      for($i = 0; $i <= $imageNumber; $i++){
        $potentialImageName = "fileToUpload_" . $i;
        if(isset($_FILES[$potentialImageName])){
          $imageNames[count($imageNames)] = $potentialImageName;
          echo $_FILES[$potentialImageName]["name"] . "<br>";
        }
        echo "count(imagesNames)" . count($imageNames). "<br>";
      }
      //Add attributes and their values to seperate arrays
      for($i = 1; $i <= 40; $i++){
        $potentialAttribute = "productAttribute_" . $i;
        $potentialAttributeValue = "productAttributeValue_" . $i;
        if(isset($_POST[$potentialAttribute]) && $_POST[$potentialAttribute] != ""){
          $attributes[count($attributes)] = $_POST[$potentialAttribute];
          if(isset($_POST[$potentialAttributeValue]) && $_POST[$potentialAttributeValue] != ""){
            $attributeValues[count($attributeValues)] = $_POST[$potentialAttributeValue];
          }
        }
      }
      //Set product information
      $productName = $_POST['productNameInput'];
      $productPrice = $_POST['productPriceInput'];
      $productDescription = $_POST['productDescriptionInput'];
      $productBrand = $_POST['productBrandInput'];
      $productQuantity = $_POST['productQuantityInput'];
      $productCategory = $_POST['productCategoryInput'];

      //Prepared mysqli query for adding a product to the database.
      if($addProduct = mysqli_prepare($connection, "INSERT INTO `Product`(`productID`, `productName`, `productPrice`, `productDescription`, `productBrand`) VALUES (null,?,?,?,?)")){
        mysqli_stmt_bind_param($addProduct, "sdss", $productName, $productPrice, $productDescription, $productBrand);
        mysqli_stmt_execute($addProduct);
        //Loop to enter product items into the database
        for($i = 1; $i <= $productQuantity; $i++){
          //This query isn't prepared but it shouldn't matter considering how no potentially malicious inputs can be present.
          $query = "INSERT INTO `Item`(`itemID`, `productID`) VALUES (null,(SELECT productID FROM Product ORDER BY productID DESC LIMIT 1))";
          $result = mysqli_query($connection, $query);
        }
        //Loop to run through the attributes and their values in the arrays
        for($i = 0; $i < count($attributes); $i++){
          //Prepared mysqli query to add those attributes and their values to the database
          if($addAttributes = mysqli_prepare($connection, "INSERT INTO `ProductAttributes`(`productID`, `attribute`, `attributeValue`) VALUES ((SELECT productID FROM Product ORDER BY productID DESC LIMIT 1),?,?)")){
            mysqli_stmt_bind_param($addAttributes, 'ss', $attributes[$i], $attributeValues[$i]);
            mysqli_stmt_execute($addAttributes);
          }
        }
        if($addCategory = mysqli_prepare($connection, "INSERT INTO ProductInCategory (productID, category) VALUES((SELECT productID FROM Product ORDER BY productID DESC LIMIT 1),?)")){
          mysqli_stmt_bind_param($addCategory, 's', $productCategory);
          mysqli_stmt_execute($addCategory);
        }
        if($getProduct = mysqli_prepare($connection2, "SELECT productID FROM Product ORDER BY productID DESC LIMIT 1")){
          mysqli_stmt_execute($getProduct);
          mysqli_stmt_bind_result($getProduct, $productID);

          while(mysqli_stmt_fetch($getProduct)){
            mkdir("images/productPhotos/".$productID."/");
            //Loop to run through the images in the array
            for($i = 0; $i <= count($imageNames); $i++){
              $allowedExts = array("gif", "jpeg", "jpg", "png");
              $temp = explode(".", $_FILES[$imageNames[$i]]["name"]);
              $extension = end($temp);
              //Check if file is actually an image
              if ((($_FILES[$imageNames[$i]]["type"] == "image/gif")
              || ($_FILES[$imageNames[$i]]["type"] == "image/jpeg")
              || ($_FILES[$imageNames[$i]]["type"] == "image/jpg")
              || ($_FILES[$imageNames[$i]]["type"] == "image/pjpeg")
              || ($_FILES[$imageNames[$i]]["type"] == "image/x-png")
              || ($_FILES[$imageNames[$i]]["type"] == "image/png"))
              && ($_FILES[$imageNames[$i]]["size"] < 5000000)
              && in_array($extension, $allowedExts)) {
                  //Checks if there could be an error
                  if ($_FILES[$imageNames[$i]]["error"] > 0) {
                      echo "Return Code: " . $_FILES[$imageNames[$i]]["error"] . "<br>";
                  }
                  else {
                    //Gets file information
                    $filename = $_FILES[$imageNames[$i]]["name"];
                    $filePath = "images/productPhotos/".$productID."/" . $filename;
                    $fileType = $_FILES[$imageNames[$i]]["type"];
                    $fileSize = $_FILES[$imageNames[$i]]["size"];
                    $fileTemp = $_FILES[$imageNames[$i]]["tmp_name"];
                    //Checks if file already exists
                    if (file_exists($filePath)) {
                      echo $filename . " already exists. ";
                    }
                    else {
                      //Uploads file
                      move_uploaded_file($_FILES[$imageNames[$i]]["tmp_name"], $filePath);
                      // echo "Stored in: " . $filePath;
                    }
                    //Prepared mysqli query to add images to the database
                    if($addImage = mysqli_prepare($connection, "INSERT INTO `ProductImages`(`productID`, `image`) VALUES ((SELECT productID from Product ORDER BY productID DESC LIMIT 1),?)")){
                      mysqli_stmt_bind_param($addImage, 's', $filePath);
                      echo $filePath;
                      mysqli_stmt_execute($addImage);
                      printf("Error: %s.\n", mysqli_stmt_error($addImage));
                    }
                  }
               }
             }
          }
        }
      }
    break;
    case "addBrand":
      //Sets brandName
      $brandName = $_POST['brand'];

      //Prepared mysqli query to add brand into the database
      if($addBrand = mysqli_prepare($connection, "INSERT INTO Brands (`brandName`) VALUES  (?)")){
        mysqli_stmt_bind_param($addBrand, "s", $brandName);
        mysqli_stmt_execute($addBrand);
      }
    break;
    case "addToCart":
        $productID = $_POST['productID'];
        $quantity = $_POST['amountOfItems'];
        $userID = $_POST['userID'];
        if(isset($_SESSION['userinfo']['userID'])){
        //Check if the cart in the session exists
        $query = "SELECT cartID from Cart where userID = {$_SESSION['userinfo']['userID']}";
        $result = mysqli_query($connection, $query);
        $numRows = mysqli_num_rows($result);
        if($numRows <= 0){
        //Prepared mysqli query for creating a cart
          if($createCart = mysqli_prepare($connection, "INSERT INTO `Cart`(`cartID`, `userID`, `lastModified`) VALUES (null, ?, ?)")){
            mysqli_stmt_bind_param($createCart, 'is', $userID, date("Y-m-d H:i:s"));
            mysqli_stmt_execute($createCart);
            // printf("Error: %s.\n", mysqli_stmt_error($createCart));
          }
        }
        else if($numRows > 0){
          if($alterDate = mysqli_prepare($connection, "UPDATE `Cart` SET `lastModified` = ? WHERE userID = ? ORDER BY cartID DESC LIMIT 1")){
            mysqli_stmt_bind_param($alterDate, 'si', date("Y-m-d H:i:s"), $userID);
            mysqli_stmt_execute($alterDate);
            // printf("Error: %s.\n", mysqli_stmt_error($alterDate));
          }
        }
        if($getItems = mysqli_prepare($connection, "SELECT itemID from Item where productID = ? AND status = 'usable' ORDER BY itemID LIMIT ?")){
          mysqli_stmt_bind_param($getItems, 'ii', $productID, $quantity);
          mysqli_stmt_execute($getItems);
          printf("Error: %s.\n", mysqli_stmt_error($getItems));
          mysqli_stmt_bind_result($getItems, $itemID);
          while(mysqli_stmt_fetch($getItems)){
            if($createCartItems = mysqli_prepare($connection2, "INSERT INTO `CartItems` (`cartItem`, `cartID`, `itemID`) VALUES (null, (SELECT cartID from `Cart` WHERE userID = ? ORDER BY cartID DESC LIMIT 1), ?)")){
              mysqli_stmt_bind_param($createCartItems, 'ii', $userID, $itemID);
              mysqli_stmt_execute($createCartItems);
              printf("Error: %s.\n", mysqli_stmt_error($createCartItems));
            }
            if($reserveItems = mysqli_prepare($connection2, "UPDATE `Item` SET `status` = ? WHERE itemID = ?")){
              $newStatus = "in cart";
              mysqli_stmt_bind_param($reserveItems, 'si', $newStatus, $itemID);
              mysqli_stmt_execute($reserveItems);
              printf("Error: %s.\n", mysqli_stmt_error($reserveItems));
              }
            }
          }
        }
      else{
        if(!in_array($productID, $_SESSION['cartProducts'])){
          $_SESSION['cartProducts'][count($_SESSION['cartProducts'])] = $productID;
        }
        $_SESSION['cart'][$productID] += $quantity;
        $_SESSION['cart']['lastModified'] = date("Y-m-d H:i:s");
        $query = 'UPDATE Item SET status = "in cart" WHERE status = "usable" AND productID = '.$productID.' LIMIT '.$quantity.'';
        $result = mysqli_query($connection, $query);
      }
    break;
    case "search":
      $search = $_POST['searchVal'];
      $properSearch = "%".$search."%";
      $filter = $_POST['filter'];
      if($getProducts = mysqli_prepare($connection, "SELECT distinct (p.productID), productName, productPrice FROM Product as p, ProductAttributes as pa WHERE p.productID = pa.productID AND (p.productName LIKE ?  OR pa.attributeValue LIKE ? OR pa.attribute LIKE ?) ORDER BY {$filter} ASC;")){
        mysqli_stmt_bind_param($getProducts, 'sss', $properSearch, $properSearch, $properSearch);
        mysqli_stmt_execute($getProducts);
        mysqli_stmt_bind_result($getProducts, $productID, $productName, $productPrice);
        $numRows = prepared_num_rows($getProducts);
        if($numRows == 0){
          echo "<h3 class='row col-md-12' style='text-align: center'> geen resultaten voor &#39;" .$search."&#39;</h3>";
        }
        else if($numRows == 1){
          echo "<h3 class='row col-md-12' style='text-align: center'> ". $numRows . " resultaat voor &#39;" .$search."&#39;</h3>";
        }
        else{
          echo "<h3 class='row col-md-12' style='text-align: center'> ". $numRows . " resultaten voor &#39;" .$search."&#39;</h3>";
        }
        while(mysqli_stmt_fetch($getProducts)){
          ?>
          <a href="<?= "index.php?content=product&id=".$productID ?>"><div id="<?=$productID?>" name="<?=$productID?>" class="searchItem col-md-8 col-md-offset-2">
            <?php if($getPicture = mysqli_prepare($connection2, "SELECT image from ProductImages WHERE productID = ?")){
              mysqli_stmt_bind_param($getPicture, 'i', $productID);
              mysqli_stmt_execute($getPicture);
              mysqli_stmt_bind_result($getPicture, $image);
              $numRows = prepared_num_rows($getPicture);
              $rowCount = 0;
              while(mysqli_stmt_fetch($getPicture)){
                $rowCount++;
                if($rowCount == 1){
                    echo '<img class="col-md-3 searchItemInfo" id="searchItemInfo" src="'.$image.'">';
                }
                ?><script>

                imageArray[imageArray.length] =  {productID: <?= $productID?>, Image: "<?= $image ?>"};</script> <?php
              }
            }?>
            <div class="col-md-8 searchItemInfoInner">
              <p class="row"><?= $productName ?></p>
              <p class="row"><?= "&#8364;".$productPrice?> </p>
            </div>
          </div></a>
          <?php
        }
      }
    break;
    case "emptyCart":
      if(isset($_SESSION['userinfo']['userID'])){
          $query = "SELECT I.itemID, c.cartID FROM Item as I, Cart as c, CartItems as ca WHERE ca.itemID = I.itemID AND c.cartID = ca.cartID AND c.cartID = (SELECT cartID from Cart WHERE userID = {$_SESSION['userinfo']['userID']} ORDER BY cartID DESC LIMIT 1)";
          $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          foreach($result as $row){
            echo $row['itemID'];
            $query = "UPDATE `Item` SET `status` = 'usable' WHERE itemID = {$row['itemID']}";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

            $removeFromCart = "DELETE FROM CartItems WHERE itemID = {$row['itemID']} AND cartID = {$row['cartID']}";
            $result = mysqli_query($connection, $removeFromCart) or die(mysqli_error($connection));
          }
          $removeCart = "DELETE FROM Cart WHERE cartID = {$row['cartID']}";
          $result = mysqli_query($connection, $removeCart) or die(mysqli_error($connection));
      }
      else{
        foreach($_SESSION['cartProducts'] as $cartProduct){
          $query = "SELECT I.itemID FROM Item as I, Product as P, CartItems as CA WHERE CA.itemID != I.itemID AND P.productID = {$cartProduct} AND P.productID = I.productID Limit {$_SESSION['cart'][$cartProduct]}";
          $result = mysqli_query($connection, $query);
          foreach($result as $row){
            $query = "UPDATE Item SET status='usable' WHERE itemID = {$row['itemID']}";
            $result = mysqli_query($connection, $query);
          }
        }
        $_SESSION['cart'] = "";
        $_SESSION['cartProducts'] = "";
      }
    break;
    case "addToFavorites":
      if($getFavorites = mysqli_prepare($connection, "SELECT userID, productID FROM `Favorites` WHERE userID = ? AND productID = ?")){
        mysqli_stmt_bind_param($getFavorites, 'ii', $_POST['userID'], $_POST['productID']);
        mysqli_stmt_execute($getFavorites);
        // printf("Error: %s.\n", mysqli_stmt_error($getFavorites));
        $inFavorites = prepared_num_rows($getFavorites);
        if($inFavorites == 0){
          echo "<b>Verwijder uit favorieten</b><img src='images/star.png' style='height: 34px; width: auto'>";
          //Delete from favorites
          if($addToFavorites = mysqli_prepare($connection, "INSERT INTO `Favorites` (`userID`, `productID`) VALUES (?, ?)")){
            mysqli_stmt_bind_param($addToFavorites, 'ii', $_POST['userID'], $_POST['productID']);
            mysqli_stmt_execute($addToFavorites);
            // printf("Error: %s.\n", mysqli_stmt_error($addToFavorites));
          }
        }
        else if($inFavorites > 0){
        echo "<b>Voeg toe aan favorieten</b><img src='images/star.png' style='height: 34px; width: auto'>";
          //Add to favorites
          if($deleteFromFavorites = mysqli_prepare($connection, "DELETE FROM `Favorites` WHERE userID = ? AND productID = ?")){
            mysqli_stmt_bind_param($deleteFromFavorites, 'ii', $_POST['userID'], $_POST['productID']);
            mysqli_stmt_execute($deleteFromFavorites);
            // printf("Error: %s.\n", mysqli_stmt_error($deleteFromFavorites));
          }
        }
      }
    break;
    case "addFromFavoritesToCart":
      $productID = $_POST['productID'];
      $userID = $_SESSION['userinfo']['userID'];
      //Check if the cart in the session exists
      $query = "SELECT cartID from Cart where userID = {$userID}";
      $result = mysqli_query($connection, $query);
      $numRows = mysqli_num_rows($result);
      if($numRows <= 0){
        //Prepared mysqli query for creating a cart
        if($createCart = mysqli_prepare($connection, "INSERT INTO `Cart`(`cartID`, `userID`, `lastModified`) VALUES (null, ?, ?)")){
          mysqli_stmt_bind_param($createCart, 'is', $userID, date("Y-m-d H:i:s"));
          mysqli_stmt_execute($createCart);
          // printf("Error: %s.\n", mysqli_stmt_error($createCart));
        }
      }
      else if($numRows > 0){
        if($alterDate = mysqli_prepare($connection, "UPDATE `Cart` SET `lastModified` = ? WHERE userID = ? ORDER BY cartID DESC LIMIT 1")){
          mysqli_stmt_bind_param($alterDate, 'si', date("Y-m-d H:i:s"), $userID);
          mysqli_stmt_execute($alterDate);
          // printf("Error: %s.\n", mysqli_stmt_error($alterDate));
        }
      }
      if($getItems = mysqli_prepare($connection, "SELECT itemID from Item where productID = ? AND status = 'usable' ORDER BY itemID LIMIT 1")){
        mysqli_stmt_bind_param($getItems, 'i', $productID);
        mysqli_stmt_execute($getItems);
        // printf("Error: %s.\n", mysqli_stmt_error($getItems));
        mysqli_stmt_bind_result($getItems, $itemID);
        while(mysqli_stmt_fetch($getItems)){
          // echo "after while: ". $itemID;
          if($createCartItems = mysqli_prepare($connection2, "INSERT INTO `CartItems` (`cartItem`, `cartID`, `itemID`) VALUES (null, (SELECT cartID from `Cart` WHERE userID = ? ORDER BY cartID DESC LIMIT 1), ?)")){
            mysqli_stmt_bind_param($createCartItems, 'ii', $userID, $itemID);
            mysqli_stmt_execute($createCartItems);
            printf("Error: %s.\n", mysqli_stmt_error($createCartItems));
            // $_SESSION['cart'][count($_SESSION['cart'])] = $productID;
          }
          if($reserveItems = mysqli_prepare($connection2, "UPDATE `Item` SET `status` = ? WHERE itemID = ?")){
            $newStatus = "in cart";
            mysqli_stmt_bind_param($reserveItems, 'si', $newStatus, $itemID);
            mysqli_stmt_execute($reserveItems);
            // printf("Error: %s.\n", mysqli_stmt_error($reserveItems));
          }
        }
      }
    break;
    case "removeFromFavorites":
      $query = "DELETE FROM Favorites WHERE productID = '{$_POST['productID']}' AND userID = '{$_SESSION['userinfo']['userID']}'";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    break;
    case "parseOrder":
      //invoice address
      $shippingStreet = $_POST['shippingStreet'];
      $shippingZipcode = $_POST['shippingZipcode'];
      $shippingCity = $_POST['shippingCity'];
      $shippingName = $_POST['shippingName'];
      $shippingEmail = $_POST['shippingEmail'];
      if($_POST['shippingEmail'] == true){
        $shippingSaveForLater = 1;
      }
      else{
        $shippingSaveForLater = 0;
      }
      //Invoice address
      $invoiceStreet = $_POST['invoiceStreet'];
      $invoiceZipcode = $_POST['invoiceZipcode'];
      $invoiceCity = $_POST['invoiceCity'];
      $invoiceName = $_POST['invoiceName'];
      $invoiceEmail = $_POST['invoiceEmail'];
      if($_POST['invoiceSaveForLater'] == true){
        $invoiceSaveForLater = 1;
      }
      else{
        $invoiceSaveForLater = 0;
      }

      Var_dump($_POST);
      //If the user is logged in
      if(isset($_SESSION['userinfo']['userID'])){
        //Get payment method
        $getPayment = "SELECT paymentMethod, bank FROM User WHERE userID = {$_SESSION['userinfo']['userID']}";
        $result = mysqli_query($connection, $getPayment);
        foreach($result as $row){
          if($row['paymentMethod'] == 'bank'){
            $status = "Wachten op betaling";
          }
          else{
            $status = "Verwerken";
          }
        }

        //Create a new order
        $createOrder = "INSERT INTO `Orders`(`orderID`, `email`, `orderPlaced`, `status`) VALUES (null,'{$_SESSION['userinfo']['email']}','".date('Y-m-d H:i:s')."','{$status}')";
        $result = mysqli_query($connection, $createOrder) or die(mysqli_error($connection));

        //Get the orderID of the previously created order
        $getOrderID = "SELECT orderID FROM Orders WHERE email = (SELECT email FROM User where userID = {$_SESSION['userinfo']['userID']})";
        $result = mysqli_query($connection, $getOrderID) or die(mysqli_error($connection));
        foreach($result as $row){
          $orderID = $row['orderID'];
        }

        //Get the cart
        $getCartID = "SELECT cartID FROM Cart WHERE userID = {$_SESSION['userinfo']['userID']}";
        $result = mysqli_query($connection, $getCartID) or die(mysqli_error($connection));
        foreach($result as $row){
          $cartID = $row['cartID'];
        }
        //Insert address details into the Shipping Address table
        $insertShippingDate = "INSERT INTO `ShippingAddress`(`orderID`, `street`, `zipcode`, `city`, `name`, `saveForLater`, `email`) VALUES ({$orderID}, '{$shippingStreet}','{$shippingZipcode}','{$shippingCity}','{$shippingName}', '{$shippingSaveForLater}', '{$shippingEmail}')";
        $result = mysqli_query($connection, $insertShippingDate) or die(mysqli_error($connection));
        //Insert address details into the Invoice Address table
        $insertInvoiceDate = "INSERT INTO `InvoiceAddress`(`orderID`, `street`, `zipcode`, `city`, `name`, `saveForLater`, `email`) VALUES ({$orderID}, '{$invoiceStreet}','{$invoiceZipcode}','{$invoiceCity}','{$invoiceName}', '{$invoiceSaveForLater}', '{$invoiceEmail}')";
        $result = mysqli_query($connection, $insertInvoiceDate) or die(mysqli_error($connection));
        //Select all the items currently in the cart
        $getCartItems = "SELECT CA.itemID from Item as I, CartItems as CA, Cart as C WHERE C.cartID = CA.cartID AND C.cartID = (SELECT cartID from Cart WHERE userID = {$_SESSION['userinfo']['userID']}) AND CA.itemID = I.itemID";
        $result = mysqli_query($connection, $getCartItems) or die(mysqli_error($connection));
        foreach($result as $row){
          //Insert all of the reserved items into the OrderDetails table
          $insertItems = "INSERT INTO OrderDetails (orderID, itemID) VALUES ({$orderID}, {$row['itemID']})";
          $result = mysqli_query($connection, $insertItems) or die(mysqli_error($connection));

          //Change the item status to 'Sold'
          $changeItem = "UPDATE `Item` SET `status`= 'Sold' WHERE itemID = {$row['itemID']}";
          $result = mysqli_query($connection, $changeItem) or die(mysqli_error($connection));
        }
        //Delete the items in the cart
        $deleteCartItems = "DELETE FROM CartItems WHERE cartID = (SELECT cartID from Cart WHERE userID = {$_SESSION['userinfo']['userID']})";
        $result = mysqli_query($connection, $deleteCartItems) or die(mysqli_error($connection));
        //Delete the cart itself
        $deleteCart = "DELETE FROM Cart WHERE cartID = {$cartID}";
        $result = mysqli_query($connection, $deleteCart) or die(mysqli_error($connection));
      }
      else if(!isset($_SESSION['userinfo']['userID']) && $_SESSION['cart'] != ""){
        $status = 'Wachten op betaling';
        //Create order
        $createOrder = "INSERT INTO `Orders`(`orderID`, `email`, `orderPlaced`, `status`) VALUES (null,'{$shippingEmail}','".date('Y-m-d H:i:s')."','{$status}')";
        $result = mysqli_query($connection, $createOrder);

        //Get the orderID of the previously created order
        $getOrderID = "SELECT orderID FROM Orders WHERE email = '{$shippingEmail}' ORDER BY orderID DESC LIMIT 1";
        $result = mysqli_query($connection, $getOrderID) or die(mysqli_error($connection));
        foreach($result as $row){
          $orderID = $row['orderID'];
        }
        //Insert address details into the Shipping Address table
        $insertShippingDate = "INSERT INTO `ShippingAddress`(`orderID`, `street`, `zipcode`, `city`, `name`, `saveForLater`, `email`) VALUES ({$orderID}, '{$shippingStreet}','{$shippingZipcode}','{$shippingCity}','{$shippingName}', '{$shippingSaveForLater}', '{$shippingEmail}')";
        $result = mysqli_query($connection, $insertShippingDate) or die(mysqli_error($connection));
        //Insert address details into the Invoice Address table
        $insertInvoiceDate = "INSERT INTO `InvoiceAddress`(`orderID`, `street`, `zipcode`, `city`, `name`, `saveForLater`, `email`) VALUES ({$orderID}, '{$invoiceStreet}','{$invoiceZipcode}','{$invoiceCity}','{$invoiceName}', '{$invoiceSaveForLater}', '{$invoiceEmail}')";
        $result = mysqli_query($connection, $insertInvoiceDate) or die(mysqli_error($connection));
        //Loop through cart
        foreach($_SESSION['cartProducts'] as $cartProduct){
          $query = "SELECT I.itemID FROM Product as p, Item as I, CartItems as CA WHERE CA.itemID != I.itemID AND p.productID = {$cartProduct} AND p.productID = I.productID AND I.status = 'in cart' ORDER BY itemID ASC LIMIT {$_SESSION['cart'][$cartProduct]}";
          $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          foreach($result as $row){
            //Insert Items into OrderDetails
            $insertItems = "INSERT INTO OrderDetails (orderID, itemID) VALUES ({$orderID}, {$row['itemID']})";
            $result = mysqli_query($connection, $insertItems) or die(mysqli_error($connection));

            //Change the item status to 'Sold'
            $changeItem = "UPDATE `Item` SET `status`= 'Sold' WHERE itemID = {$row['itemID']}";
            $result = mysqli_query($connection, $changeItem) or die(mysqli_error($connection));
          }
        }
        $_SESSION['cart'] = "";
        $_SESSION['cartProducts'] = "";
      }
      $email = $shippingEmail;
      include('dompdf.php');
    break;
    case "changeItem":
      //Setting variables from information given in $_POST
      $item = $_POST['item'];
      $status = $_POST['status'];
      //Select product
      $getProduct = "SELECT productID FROM Item WHERE itemID = '{$item}'";
      $result = mysqli_query($connection, $getProduct);
      //Loop through products (should be 1)
      foreach($result as $row){
        //Setting variables from information given in above query
        $product = $row['productID'];
        //Update item to change status to whatever the employee wanted
        $query = "UPDATE Item SET status = '{$status}' WHERE itemID = '{$item}'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        //Get all items of a given product
        $query = "SELECT * FROM Item WHERE productID = '{$product}'";
        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        //Start feedback
        echo '<option> Selecteer een exemplaar </option>';
        echo $_POST['productID'];
        //Loop through all items for feedback
        foreach($result as $row){
          if($row['status'] == 'usable'){
            $displayStatus = 'Bruikbaar';
          }
          if($row['status'] == 'In Cart'){
            $displayStatus = 'In Winkelmandje';
          }
          if($row['status'] == 'Sold'){
            $displayStatus = 'Verkocht';
          }
          echo '<option value="'.$row['itemID'].'">('.$row['itemID'].') '.$displayStatus.'</option>';
        }
      }
    break;
    case "clearCheckoutCart":
      //Setting variables from information given in $_POST
      $productID = $_POST['productID'];
      //Select all items in cart
      $query = "SELECT CA.itemID FROM CartItems as CA, Item as I, Product as P, Cart as C WHERE P.productID = I.productID AND I.itemID = CA.itemID AND P.productID = {$productID} AND C.cartID = CA.cartID AND C.userID = {$_SESSION['userinfo']['userID']}";
      $result = mysqli_query($connection, $query);
      //Loop through products
      foreach($result as $row){
        //Delete item from cart
        $query = "DELETE FROM CartItems WHERE itemID = {$row['itemID']}";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        //Update item status to make it usable again
        $query = "UPDATE Item SET status = 'usable' WHERE itemID = {$row['itemID']}";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      }
    break;
    case "removeFromCheckoutCart":
      //Setting variables from information given in $_POST
      $productID = $_POST['productID'];
      //Select single item
      $query = "SELECT CA.itemID FROM CartItems as CA, Item as I, Product as P, Cart as C WHERE P.productID = I.productID AND I.itemID = CA.itemID AND P.productID = {$productID} AND C.cartID = CA.cartID AND C.userID = {$_SESSION['userinfo']['userID']} LIMIT 1";
      $result = mysqli_query($connection, $query);
      //Loop through results (should only be one)
      foreach($result as $row){
        //Delete item from cart
        $query = "DELETE FROM CartItems WHERE itemID = {$row['itemID']}";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        //Update item status to make it usable again
        $query = "UPDATE Item SET status = 'usable' WHERE itemID = {$row['itemID']}";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      }
    break;
    case "requestProduct":
      //Setting variables from information given in $_POST
      $product = $_POST['product'];
      $reason = $_POST['reason'];
      //Create request
      $query = "INSERT INTO `Requests`(`userID`, `productID`, `reason`) VALUES ({$_SESSION['userinfo']['userID']},{$product},'{$reason}')";
      //Error Handling
      if($result = mysqli_query($connection, $query)){
        echo 'U aanvraag is binnen gekomen.';
      }
      else{
        //Echo the mysqli error number
        if(mysqli_errno($connection) == '1062'){
          echo 'U heeft dit product al aangevraagd.';
        }
      }
    break;
    case "addExpiredProduct":
      //Setting variables from information given in $_POST
      $productID = $_POST['product'];
      //Select request
      $query = "SELECT U.*, R.* FROM Requests as R, User as U WHERE U.userID = R.userID AND R.productID = {$productID}";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      foreach($result as $row){
        //Setting variables from information given in above query
        $user = $row['userID'];
        $email = $row['email'];
        $name = $row['name'];
        //Include PHPMailer plugin
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->setFrom('noreply@examen.aaronvanleijenhorst.xyz', 'Fietsen Winkel');
        $mail->addAddress($email, $name);
        $mail->Subject  = 'Uw aanvraag bij examen.aaronvanleijenhorst.xyz';
        $mail->isHTML(true);
        $mail->Body     = '
        <h1> Uw aanvraag voor de {} is toegekeurd. </h1>
        <h4> Het product zal binnenkort weer verkrijgbaar zijn. </h4>
        ';
        //Sending email is off to stop email spam
        //$mail->send();
        //Update request
        $query = "UPDATE `Requests` SET `status`= 'Geaccepteerd' WHERE productID = {$productID} AND userID = {$user} LIMIT 1";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      }
    break;
    case "dontAddExpiredProduct":
      //Setting variables from information given in $_POST
      $productID = $_POST['product'];
      //Select user information
      $query = "SELECT U.*, R.* FROM Requests as R, User as U WHERE U.userID = R.userID AND R.productID = {$productID}";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      foreach($result as $row){
        //Setting variables from information given in the above query
        $user = $row['userID'];
        $email = $row['email'];
        $name = $row['name'];
        //Include PHPMailer plugin
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->setFrom('noreply@examen.aaronvanleijenhorst.xyz', 'Fietsen Winkel');
        $mail->addAddress($email, $name);
        $mail->Subject  = 'Uw aanvraag bij examen.aaronvanleijenhorst.xyz';
        $mail->isHTML(true);
        $mail->Body     = '
        <h1> Uw aanvraag voor de {} is Afgewezen. </h1>
        <h4> Het spijt ons dat we het product niet toe hebben kunnen voegen, hier kunnen meerdere redenen voor zijn. </h4>
        ';
        //Sending email is off to stop email spam
        //$mail->send();

        //Update request
        $query = "UPDATE `Requests` SET `status`= 'Afgewezen' WHERE productID = {$productID} AND userID = {$user} LIMIT 1";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      }
    break;
    case "addItems":
      //Setting variables from information given in $_POST
      $productID = $_POST['product'];
      $amount = $_POST['amount'];
      //Set counts to 0
      $count = 0;
      $errorCount = 0;

      //Loop to create items
      for($i = 0; $i < $amount; $i++){
        $query = "INSERT INTO `Item`(`itemID`, `productID`, `status`) VALUES (null,{$productID},'usable')";
        //Error handling
        if($result = mysqli_query($connection, $query)){
          $count++;
        }
        else{
          $errorCount++;
        }
      }
      //Give feedback
      echo $count." exemplaren toegevoegd met ".$errorCount." fouten.";
    break;
    case "removeImage":
      //Setting variables from information given in $_POST
      $product = $_POST['product'];
      $image = $_POST['image'];

      //Delete images
      $query = "DELETE FROM ProductImages WHERE image = '{$image}'";
      $result = mysqli_query($connection, $query);
    break;
    case "addImages":
      //Setting variables from information given in $_POST
      $product = $_POST['product'];

      //Add images to array
      for($i = 0; $i <= $_POST['lastImage']; $i++){
        $potentialImageName = "fileToUpload_" . $i;
        if(isset($_FILES[$potentialImageName])){
          $imageNames[count($imageNames)] = $potentialImageName;
          echo $_FILES[$potentialImageName]["name"] . "<br>";
        }
        echo "count(imagesNames)" . count($imageNames). "<br>";
      }

      for($i = 0; $i <= count($imageNames); $i++){
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES[$imageNames[$i]]["name"]);
        $extension = end($temp);
        //Check if file is actually an image
        if ((($_FILES[$imageNames[$i]]["type"] == "image/gif")
        || ($_FILES[$imageNames[$i]]["type"] == "image/jpeg")
        || ($_FILES[$imageNames[$i]]["type"] == "image/jpg")
        || ($_FILES[$imageNames[$i]]["type"] == "image/pjpeg")
        || ($_FILES[$imageNames[$i]]["type"] == "image/x-png")
        || ($_FILES[$imageNames[$i]]["type"] == "image/png"))
        && ($_FILES[$imageNames[$i]]["size"] < 5000000)
        && in_array($extension, $allowedExts)) {
            //Checks if there could be an error
            if ($_FILES[$imageNames[$i]]["error"] > 0) {
                echo "Return Code: " . $_FILES[$imageNames[$i]]["error"] . "<br>";
            }
            else {
              //Gets file information
              $filename = $_FILES[$imageNames[$i]]["name"];
              $filePath = "images/productPhotos/".$product."/" . $filename;
              $fileType = $_FILES[$imageNames[$i]]["type"];
              $fileSize = $_FILES[$imageNames[$i]]["size"];
              $fileTemp = $_FILES[$imageNames[$i]]["tmp_name"];
              //Checks if file already exists
              if (file_exists($filePath)) {
                echo $filename . " already exists. ";
              }
              else {
                //Uploads file
                move_uploaded_file($_FILES[$imageNames[$i]]["tmp_name"], $filePath);
                // echo "Stored in: " . $filePath;
              }
              //Prepared mysqli query to add images to the database
              if($addImage = mysqli_prepare($connection, "INSERT INTO `ProductImages`(`productID`, `image`) VALUES (?,?)")){
                mysqli_stmt_bind_param($addImage, 'is', $product, $filePath);
                echo $filePath;
                mysqli_stmt_execute($addImage);
                printf("Error: %s.\n", mysqli_stmt_error($addImage));
              }
            }
         }
       }
    break;
    case "updateProduct":
      //Setting variables from information given in $_POST
      $attributes = json_decode($_POST['attributes']);
      $attributeValues = json_decode($_POST['attributeValues']);
      $productName = $_POST['productName'];
      $productPrice = $_POST['productPrice'];
      $productDescription = $_POST['productDescription'];
      $productBrand = $_POST['productBrand'];
      $productID = $_POST['product'];
      $productCategory = $_POST['productCategory'];

      //Update product
      $query = "UPDATE Product SET productName = '{$productName}', productPrice = '{$productPrice}', productDescription = '{$productDescription}', productBrand = '{$productBrand}' WHERE productID = {$productID}";
      $result = mysqli_query($connection, $query);
      //Update category
      $query = "UPDATE ProductInCategory SET category = '{$productCategory}' WHERE productID = {$productID}";
      $result = mysqli_query($connection, $query);
      //Delete attributes
      $query = "DELETE FROM ProductAttributes WHERE productID = {$productID}";
      $result = mysqli_query($connection, $query);
      //Loop to add attributes again
      for($i = 0; $i < count($attributes); $i++){
        $query = "INSERT INTO ProductAttributes (`productID`, `attribute`, `attributeValue`) VALUES ({$productID}, '{$attributes[$i]}', '{$attributeValues[$i]}')";
        $result = mysqli_query($connection, $query);
      }
    break;
    case "updateBrand":
      //Setting variables from information given in $_POST
      $brand = $_POST['brand'];
      $description = $_POST['description'];

      //Update brand
      $query = "UPDATE Brands SET brandDescription = '{$description}' WHERE brandName = '{$brand}'";
      //Error handling
      if($result = mysqli_query($connection, $query)){
        echo 'Brand Updated';
      }
      else{
        echo 'Er was een probleem, neem contact op met een beheerder.';
      }
    break;
    case "addCategory":
     //Setting variable with information given in $_POST
     $category = $_POST['category'];

     //Updating category
     $query = "INSERT INTO Category (category, description) VALUES ('{$category}', null)";
     $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    break;
    case "addRole":
      $user = $_POST['userID'];
      $role = $_POST['role'];
      $query = "INSERT INTO `UserRoles`(`role`, `userID`) VALUES ('{$role}','{$user}')";
      if($result = mysqli_query($connection, $query)){
        echo 'Rol Toegevoegd.';
      }
      else{
        echo 'er was een probleem, Error code: '.mysqli_errno($connection);
      }
    break;
    case "removeRole":
      $user = $_POST['user'];
      $role = $_POST['role'];
      $query = "DELETE FROM UserRoles WHERE userID = {$user} AND role = '{$role}'";
      if(!$result = mysqli_query($connection, $query)){
        echo 'Error: #'. mysqli_errno($connection).': '.mysqli_error($connection);
      }
    break;
    case "changeUser":
      $user = $_POST['userID'];
      $name = $_POST['name'];
      $paymentMethod = $_POST['paymentMethod'];
      $bank = $_POST['bank'];
      if($paymentMethod != 'ideal'){
        $bank = '';
      }
      $email = $_POST['email'];
      $password = $_POST['password'];
      $status = $_POST['status'];

      $query = "UPDATE `User` SET `name`='{$name}',`email`='{$email}',`paymentMethod`='{$paymentMethod}',`bank`='{$bank}' WHERE userID = '{$user}'";
      $result = mysqli_query($connection, $query) or die('update user: '.mysqli_error($connection));
      if($password != ''){
        $password = md5($password);
        $query = "UPDATE `UserSecurity` SET passwordHash`= '{$password}', `accountStatus`='{$status}' WHERE userID = {$user}";
        $result = mysqli_query($connection, $query) or die('update password: '.mysqli_error($connection));
      }
      else{
        $query = "UPDATE `UserSecurity` SET `accountStatus`='{$status}' WHERE userID = {$user}";
        $result = mysqli_query($connection, $query) or die('update status: '.mysqli_error($connection));
      }
      echo 'Gegevens opgeslagen';
    break;
    case "getProducts":
      $query = "SELECT * FROM ProductImages WHERE productID = {$_POST['product']} LIMIT 1";
      $result = mysqli_query($connection, $query);
      foreach($result as $row){
        ?>
        <img src="<?=$row['image']?>" class='col-md-4'>
        <button class='addSale' product='<?=$row['productID']?>'> Add Sale </button>
        <?php
      }
    break;
    case "POTD":
      $date = date("Y.m.d");
      $query = "SELECT * FROM ProductSale WHERE date = '{$date}'";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      $output = "";
      foreach($result as $row){
        $query = "DELETE FROM ProductSale WHERE date = '{$date}' AND productID = '{$row['productID']}'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $ouput = "Vorige Korting verwijderd, ";
      }
      $query = "INSERT INTO ProductSale (`productID`, `date`) VALUES ('{$_POST['product']}', '{$date}')";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      $output .= 'Nieuwe korting toegevoegd.';
      echo $output;
    break;
  }
}
else{
  echo "action not set";
}
 ?>
