<?php
require('../db_connect.php');
if(isset($_POST['productID'])){
  $query = "SELECT * FROM Item WHERE productID = '{$_POST['productID']}'";
  $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
  echo '<option value="default"> Selecteer een exemplaar </option>';
  echo $_POST['productID'];
  foreach($result as $row){
    if($row['status'] == 'usable'){
      $displayStatus = 'Bruikbaar';
    }
    if($row['status'] == 'In Cart'){
      $displayStatus = 'In Winkelmandje';
    }
    if($row['status'] == 'Sold'){
      $displayStatus = 'Verkocht';
    }
    echo '<option value="'.$row['itemID'].'">('.$row['itemID'].') '.$displayStatus.'</option>';
  }
}
?>
