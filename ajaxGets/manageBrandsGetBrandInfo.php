<?php
require('../db_connect.php');
if(isset($_POST['brand'])){
  $brand = $_POST['brand'];
  $query = "SELECT * FROM Brands WHERE brandName = '{$brand}'";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    $description = $row['brandDescription'];
    ?>
    <div class='productChangeForm row'>
        <div class='col-md-6 col-md-offset-1'>
          <div class='row col-md-12 changeTitle'>Merk Omschrijving</div>
          <textarea class="row col-md-12" id="brandDescriptionInput" name="brandDescriptionInput" rows="5"><?=$description?></textarea>
        </div>
    </div>
    <div class='productChangeForm row'>
      <button class='col-md-4 col-md-offset-4 saveWorkBrand btn btn-danger row'>Sla Uw Werk Op</button>
    </div>
    <div class='productChangeForm row'>
      <h4 id='brandFeedback' class='row' style='text-align: center'></h4>
    </div>
    <?php
  }
}
?>
<script>

</script>
