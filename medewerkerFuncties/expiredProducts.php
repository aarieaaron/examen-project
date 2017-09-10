<?php
$query = "SELECT count(reason) as count, P.* FROM Requests as R, Product as P WHERE P.productID = R.productID GROUP BY R.productID";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
foreach($result as $row){
  ?>
  <div class='medewerkerExpiredProduct row col-md-10 col-md-offset-1' shown='false'>
    <div class='expiredProductButton row'>
      <div><h4 class='col-md-6'>Product: <?=$row['productName']."(".$row['productID'].")"?></h4><h4 class='col-md-5'>Door: <?=$row['count']. " Klant(en)"?></h4><i class="fa fa-caret-right" style="font-size: 24px;" aria-hidden="true"></i></div>
    </div>
    <div class='expiredProductInfo row'>
      <?php
      $query = "SELECT U.*, R.* FROM Requests as R, User as U WHERE U.userID = R.userID AND R.productID = {$row['productID']}";
      $result = mysqli_query($connection, $query);
      $counter = 0;
      foreach($result as $row){
        $counter++;
        ?>
        <div class='expiredProduct2 col-md-5 col-md-offset-1' shown='false'>
          <div class='expiredProductsUser row'>
            <div class='col-md-11'><?= "#".$counter." ". $row['name']."(".$row['userID'].")"?></div><div class='col-md-1'><i class="fa fa-caret-right" style="font-size: 24px;" aria-hidden="true"></i></div>
          </div>
          <div class='expiredProductsUserInfo row'>
            <?= $row['reason'] ?>
          </div>
        </div>
        <?php
      }
      ?>
      <div class='col-md-5 col-md-offset-1'>
        <button class='col-md-2 dontAddProduct' product="<?=$row['productID']?>"><i class="fa fa-times" aria-hidden="true"></i></button>
        <button class='col-md-2 col-md-offset-8 addProduct' product="<?=$row['productID']?>"><i class="fa fa-check" aria-hidden="true"></i></button>
      </div>
      <div class='col-md-5 col-md-offset-1'>
        <p id='confirmationText'></p>
      </div>
    </div>
  </div>
  <?php
}
?>
<script>
$(".dontAddProduct").click(function(){
  var info = {};
  info.product = $(this).attr('product');
  info.action = "dontAddExpiredProduct";
  function onComplete(data){
    $("#confirmationText").html(data.responseText);
  }
  parseAjax(info, onComplete);
});

$(".addProduct").click(function(){
  var info = {};
  info.product = $(this).attr('product');
  info.action = "addExpiredProduct";
  function onComplete(data){
    $("#confirmationText").html(data.responseText);
  }
  parseAjax(info, onComplete);
});
$(".expiredProductButton").click(function(){
  if($(this).parent().attr('shown') == 'false'){
    $(this).parent().find(".fa-caret-right").rotate("90");
    $(this).parent().attr('shown', 'true');
    $(this).parent().find('.expiredProductInfo').show();
  }
  else if($(this).parent().attr('shown') == 'true'){
    $(this).parent().find(".fa-caret-right").rotate("0");
    $(this).parent().attr('shown', 'false');
    $(this).parent().find('.expiredProductInfo').hide();
  }
});

$(".expiredProductsUser").click(function(){
  if($(this).parent().attr('shown') == 'false'){
    $(this).parent().find(".fa-caret-right").rotate("90");
    $(this).parent().attr('shown', 'true');
    $(this).parent().find('.expiredProductsUserInfo').show();
  }
  else if($(this).parent().attr('shown') == 'true'){
    $(this).parent().find(".fa-caret-right").rotate("0");
    $(this).parent().attr('shown', 'false');
    $(this).parent().find('.expiredProductsUserInfo').hide();
  }
});
</script>
