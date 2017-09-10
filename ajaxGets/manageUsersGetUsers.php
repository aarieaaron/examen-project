<?php
require('../db_connect.php');
$query = "SELECT * FROM User";
$result = mysqli_query($connection, $query);
  echo '<option value="">Kies een klant</option>';
foreach($result as $row){
  echo '<option value="'.$row['userID'].'">'.$row['name'].'('.$row['userID'].')</option>';
}
?>
