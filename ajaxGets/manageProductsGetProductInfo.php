<?php
require('../db_connect.php');
if(isset($_POST['product'])){
  $productID = $_POST['product'];
  $query = "SELECT * FROM Product as P, ProductInCategory as PiC WHERE P.productID = {$productID} AND P.productID = PiC.productID";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    $productName = $row['productName'];
    $productPrice = $row['productPrice'];
    $productBrand = $row['productBrand'];
    $productBrand = $row['productBrand'];
    $productDescription = $row['productDescription'];
    $productCategory = $row['category'];
    ?>
    <div class='productChangeForm row'>
      <div class='col-md-4 col-md-offset-1'>
        <div class='row col-md-12 changeTitle'>Product Naam</div>
        <input class='row col-md-12' type='text' id='changeProductName' value='<?=$productName?>'>
      </div>
      <div class='col-md-2'>
        <div class='row col-md-12 changeTitle'>Price</div>
        <input class='row col-md-12' type="number" id="changeProductPrice" value="<?=$productPrice?>" step="0.01">
      </div>
      <div class='col-md-2'>
        <div class='row col-md-12 changeTitle'>Merk</div>
        <select class='row col-md-12' id="changeProductBrand">
          <?php
          $query = "SELECT * FROM Brands";
          $result = mysqli_query($connection, $query);
          foreach($result as $row){
            if($row['brandName'] == $productBrand){
              $checked = 'selected';
            }
            else{
              $checked = '';
            }
            echo '<option value="'.$row['brandName'].'" '.$checked.'>'.$row['brandName'].'</option>';
          }
          ?>
        </select>
      </div>
      <div class='col-md-2'>
        <div class='row col-md-12 changeTitle'>Categorie</div>
        <select class='row col-md-12' id="changeProductCategory">
          <?php
          $query = "SELECT * FROM Category";
          $result = mysqli_query($connection, $query);
          foreach($result as $row){
            if($row['category'] == $productCategory){
              $checked = 'selected';
            }
            else{
              $checked = '';
            }
            echo '<option value="'.$row['category'].'" '.$checked.'>'.$row['category'].'</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class='productChangeForm row'>
        <div class='col-md-6 col-md-offset-1'>
          <div class='row col-md-12 changeTitle'>Product Omschrijving</div>
          <textarea class="row col-md-12" id="productDescriptionInput" name="productDescriptionInput" rows="5"><?=$productDescription?></textarea>
        </div>
    </div>
    <div class='productChangeForm row'>
      <div class='attributeWrapper2'>
      </div>
    </div>
    <div class='productChangeForm row'>
      <button class='col-md-4 col-md-offset-4 saveWork btn btn-danger'>Sla Uw Werk Op</button>
    </div>
    <div class='productChangeForm row'>
      <div class='imageWrapper col-md-8 col-md-offset-2'>
      </div>
    </div>

    <div class='productChangeForm addImageContainer row' product='<?= $productID ?>'>
      <form class='addImageWrapper col-md-8 col-md-offset-2' id='addImageWrapper'>
      </form>
      <button class='col-md-4 col-md-offset-4 btn btn-primary addImagesButton'>Voeg Foto's Toe</button>
    </div>
    <div class="addItems row col-md-6 col-md-offset-3">
      <h4>Voeg Exemplaren Toe</h4>
      <input type='number' step="1" class='col-md-6'><button class='btn btn-primary col-md-6'>Voeg Exemplaren Toe</button>
      <h5 id='feedbackText'></h5>
    </div>
    <div class='manageItems row'>
      <select class='selectItems col-md-4 col-md-offset-4 row'>
      </select>
      <div class="itemInfo col-md-10 col-md-offset-1 row">
      </div>
    </div>
    <?php
  }
}
?>
<script>
$(".selectItems").change(function(){
  if($(".selectItems").val() != "default"){
    console.log('change');
    var info = {};
    info.item = $(this).val();
    function onComplete(data){
      $(".itemInfo").html(data.responseText);
    }
    parseAjaxReturn(info, onComplete, 'ajaxGets/manageProductsGetItemInfo.php');
  }
  else{
    $(".itemInfo").html("");
  }
});
$(".addItems button").click(function(){
  var info = {};
  info.action = "addItems";
  info.product = '<?= $productID ?>';
  info.amount = $(this).siblings('input[type="number"]').val();
  console.log(info);
  function onComplete(data){
    $("#feedbackText").html(data.responseText);
  }
  parseAjax(info, onComplete);
});
$(document).on('click', '.saveWork', function(){
  var info = {};
  var attributes = [];
  var attributeValues = [];
  info.action = 'updateProduct';
  info.product = '<?= $productID ?>';
  info.productPrice = $('#changeProductPrice').val();
  info.productDescription = $('#productDescriptionInput').val();
  info.productName = $('#changeProductName').val();
  info.productBrand = $('#changeProductBrand').val();
  info.productCategory = $('#changeProductCategory').val();
  for(var i = 0; i < $(".attributeWrapperInner").length; i++){
    attributes[i] = $(".attributeInner:eq("+i+")").val();
    attributeValues[i] = $(".attributeValueInner:eq("+i+")").val();
  }
  function onComplete(data){
    console.log('done');
  }
  info.attributes = JSON.stringify(attributes);
  info.attributeValues = JSON.stringify(attributeValues);
  parseAjax(info, onComplete);
  console.log(info);
});
</script>
