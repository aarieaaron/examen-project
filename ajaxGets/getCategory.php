<?php
require("../db_connect.php");
echo "<option disabled>Kies een categorie.</option>";
if($getCategories = mysqli_prepare($connection, "SELECT `category` FROM Category")){
  mysqli_stmt_execute($getCategories);
  mysqli_stmt_bind_result($getCategories, $category);
  while (mysqli_stmt_fetch($getCategories)) {
    echo '<option value="'.$category.'">'.$category.'</option>';
  }
}
echo '<option value="addCategory">Voeg een category toe</option>';
?>
