<?php
if(isset($_GET['category']) && $_GET['category'] != ""){
  $search = $_GET['category'];
  if($getProducts = mysqli_prepare($connection, "SELECT distinct (p.productID), productName, productPrice FROM Product as p, ProductInCategory as PiC WHERE p.productID = PiC.productID AND PiC.category = ?;")){
    mysqli_stmt_bind_param($getProducts, 's', $search);
    mysqli_stmt_execute($getProducts);
    mysqli_stmt_bind_result($getProducts, $productID, $productName, $productPrice);
    $numRows = prepared_num_rows($getProducts);
    if($numRows == 0){
      echo "<h3 class='row col-md-12' style='text-align: center'> GEEN RESULTATEN </h3>";
    }
    else if($numRows == 1){
      echo "<h3 class='row col-md-12' style='text-align: center'> ". $numRows . " RESULTAAT</h3>";
    }
    else{
      echo "<h3 class='row col-md-12' style='text-align: center'> ". $numRows . " RESULTATEN</h3>";
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
}



?>
