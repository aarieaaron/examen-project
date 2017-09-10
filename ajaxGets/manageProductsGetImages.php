<h3>Verwijder Foto's</h3>
<?php
require('../db_connect.php');
require('../functions.php');
$product = $_POST['product'];
$query = "SELECT * FROM ProductImages WHERE productID = {$product}";
$result = mysqli_query($connection, $query);
foreach($result as $row){
  ?>
  <div class='imageInformationWrapper col-md-6' product='<?=$product?>'>
    <img src='<?= $row['image'] ?> ' class='col-md-8'><button class='btn btn-danger col-md-4'>Verwijder</button>
  </div>
  <?php
}
?>
