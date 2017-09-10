<?php
require('../db_connect.php');
session_start();

$query = "SELECT count(I.itemID) FROM Item as I, Product as P WHERE P.productID = I.productID AND P.productID = {$_POST['product']} AND I.status = 'usable'";
$result = mysqli_query($connection, $query);
foreach($result as $row){
  $productCount = $row['count(I.itemID)'];
}
echo '
<div class="form-group row">
  Aantal producten op voorraad: <div class="productCount">'.$productCount.'</div>
</div>
<div class="form-group col-md-1" style="margin: 0px; padding: 0px; width: 4.3333%">
  <input type="number" value="1" class="form-control amountOfItems" style="margin: 0px;">
</div>
<div class="form-group" style="margin: 0px; padding: 0px">
  <button style="margin: 0px;" class="btn btn-primary orderButton changeCart">Bestel</button>
</div>';
?>
