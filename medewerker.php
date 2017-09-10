<?php
if(hasRole("medewerker")){
  ?>
  <div class="container col-md-12">
    <div class="row actionNavbar">
      <button class="col-md-2 col-sm-3 manageProducts">Beheer Producten</button>
      <button class="col-md-2 col-sm-3 expiredProducts">Vervallen Producten</button>
      <button class="col-md-2 col-sm-3 addProducts">Voeg Producten Toe</button>
      <button class="col-md-2 col-sm-3 manageBrands">Beheer Merken</button>
      <button class="col-md-40px exitProducts"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>
    <div class="row medewerkerContent">
      <?php
          if(isset($_GET['function']) && $_GET['function'] == 'manage_products'){
            $hidden = 'inline';
          }
          else{
            $hidden = 'none';
          }
          ?>
          <div class="manageProductsContent col-md-12" style='display: <?=$hidden?>'>
            <h3 class="col-md-12 medewerkerHeader">Beheer Producten.</h3>
            <?php require('medewerkerFuncties/manageProducts.php'); ?>
          </div>
          <?php
          if(isset($_GET['function']) && $_GET['function'] == 'expired_products'){
            $hidden = 'inline';
          }
          else{
            $hidden = 'none';
          }
          ?>
          <div class="expiredProductsContent col-md-12"  style='display: <?=$hidden?>'>
            <h3 class="col-md-12 medewerkerHeader">Vervallen Producten.</h3>
            <?php require('medewerkerFuncties/expiredProducts.php') ?>
          </div>
          <?php
          if(isset($_GET['function']) && $_GET['function'] == 'add_products'){
            $hidden = 'inline';
          }
          else{
            $hidden = 'none';
          }
          ?>
          <div class="addProductsContent col-md-12" style='display: <?=$hidden?>'>
            <h3 class="col-md-12 medewerkerHeader">Voeg Producten Toe.</h3>
            <?php require('medewerkerFuncties/addProducts.php') ?>
          </div>
          <?php
          if(isset($_GET['function']) && $_GET['function'] == 'manage_brands'){
            $hidden = 'inline';
          }
          else{
            $hidden = 'none';
          }
          ?>
          <div class="manageBrandsContent col-md-12" style='display: <?=$hidden?>'>
            <h3 class="col-md-12 medewerkerHeader">Beheer Merken.</h3>
            <?php require('medewerkerFuncties/manageBrands.php') ?>
          </div>
          <?php
          if(!isset($_GET['function'])){
            $hidden = 'display';
          }
          else{
            $hidden = 'none';
          }
          ?>
          <div class="defaultMessageContent col-md-12" style="display: <?= $hidden ?>">
            <h2>Klik op een knop om een actie uit te voeren.</h2>
          </div>
      ?>
    </div>
  </div>
  <?php
}
?>
<script>

// $(".medewerkerContent").children().hide();
// $(".defaultMessageContent").show();

switchAction(".manageProducts", ".manageProductsContent");
switchAction(".expiredProducts", ".expiredProductsContent");
switchAction(".exitProducts", ".defaultMessageContent");
switchAction(".addProducts", ".addProductsContent");
switchAction(".manageBrands", ".manageBrandsContent");

</script>
