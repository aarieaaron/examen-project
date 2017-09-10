<div class="expiredProductsWrapper">
  <h3 class='row'>Selecteer Een Product</h3>
  <div class='productWrapper row col-md-8 col-md-offset-2'>
  <?php
  function getQuery($productID){
    require('db_connect.php');
    $query = "SELECT * FROM Product as P, ProductImages as PI WHERE P.productID = {$productID} AND (P.productID = PI.productID) LIMIT 1";
    $result = mysqli_query($connection, $query);
    foreach($result as $row){
      ?>
      <div class='expiredProduct col-md-6' product='<?=$row['productID']?>' clicked='false'>
        <div class='col-md-5 expiredProductImage'><img src='<?=$row['image']?>'  style='height: 90%; margin-top: 10%'></div><h5 class='expiredProductName'><?= $row['productName']; ?></h5>
      </div>
      <?php
    }
  }
  $query = "SELECT productID FROM Product";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    $mainProductID = $row['productID'];
    $query = "SELECT productID, count(itemID) as count FROM Item WHERE productID = '{$row['productID']}'";
    $result = mysqli_query($connection, $query);
    foreach($result as $row){
      $productID = $row['productID'];
      $count = $row['count'];
      if($count > 0){
        $query = "SELECT productID, count(itemID) as newCount FROM Item WHERE status = 'Sold' AND productID = {$productID} GROUP BY productID";
        $result = mysqli_query($connection, $query);
        foreach($result as $row){
          $newCount = $row['newCount'];
          $productID = $row['productID'];
          if($newCount == $count){
            getQuery($productID);
          }
        }
      }
      else{
        getQuery($mainProductID);
      }
    }
  }
  ?>
  </div>
  <div class='expiredProductsForm row'>
    <h3 class='row col-md-12'>Geef een reden</h3>
    <div class='expiredProductText col-md-6 col-md-offset-1'>
    </div>
    <div class='expiredProductInput col-md-5'>
      <form id='expiredProductForm'>
        <input type='text' placeholder='reden' required><input type='submit' value='Verstuur'>
      </form>
    </div>
    <p class='row' id='confirmationText'></p>
  </div>
</div>
<script>
var productID = "";
$(".expiredProduct").click(function(){
  if($(this).attr('clicked') == 'false'){
    $(".expiredProductsForm").show();
    productID = $(this).attr('product');
    $(this).css({"background-color": "green"});
    $(this).siblings().css({"background-color": "blue"});
    $(this).siblings().attr('clicked', 'false');
    $(this).attr('clicked', 'true');
    console.log($(this).attr('product'));
    $(".expiredProductText").html('Ik wil de ' +$(this).children('h5').html()+ ' terug in het assortiment, omdat:');
  }
});

$("#expiredProductForm").submit(function(e){
  e.preventDefault();
  var info = {};
  info.reason = $(this).children('input[type="text"]').val();
  info.action = 'requestProduct';
  info.product = productID;
  console.log(info);
  function onComplete(data){
    $("#confirmationText").html(data.responseText);
  }
  parseAjax(info, onComplete);
});

</script>
