<?php
?>
<script src='functions.js'></script>
<select class='selectProduct'>
  <?php
  $query = "SELECT * FROM Product";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    echo '<option value="'.$row['productID'].'">'.$row['productName'].'</option>';
  }

  ?>
</select>
<div class='selectedProduct'>
</div>
<p class='feedbackText'></p>
<script>
$(document).on('change', '.selectProduct', function(){
  var info = {}
  info.product = $(this).val();
  info.action = 'getProducts';
  function onComplete(data){
    $(".selectedProduct").html(data.responseText);
  }
  parseAjax(info, onComplete);
});
$(document).on('click', '.addSale', function(){
  var info = {}
  info.product = $(this).attr('product');
  info.action = 'POTD';
  function onComplete(data){
    $('.feedbackText').html(data.responsetText);
  }
  parseAjax(info, onComplete);
});
</script>
