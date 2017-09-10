<?php
require("../db_connect.php");
echo "<option disabled>Kies een merk.</option>";
if($getBrands = mysqli_prepare($connection, "SELECT `brandName` FROM Brands")){
  mysqli_stmt_execute($getBrands);
  mysqli_stmt_bind_result($getBrands, $brandName);
  while (mysqli_stmt_fetch($getBrands)) {
    echo '<option value="'.$brandName.'">'.$brandName.'</option>';
  }
}
echo '<option value="addBrand">Voeg een merk toe</option>';
?>
