<?php
require('../db_connect.php');

$query = "SELECT * FROM Item WHERE itemID = {$_POST['item']}";
$result = mysqli_query($connection, $query);
foreach($result as $row){
  ?>
  <div class='col-md-5'>
    <div class='row col-md-12 changeTitle'>Status</div>
    <select class='row col-md-12' id="changeItemStatus">
      <?php
      $statuses = ['usable','Sold','In Cart'];
      for($i = 0; $i < count($statuses); $i++){
        if($row['status'] == $statuses[$i]){
          $checked = 'selected';
        }
        else{
          $checked = '';
        }
        if($statuses[$i] == 'usable'){
          $displayStatus = 'Bruikbaar';
        }
        if($statuses[$i] == 'In Cart'){
          $displayStatus = 'In Winkelmandje';
        }
        if($statuses[$i] == 'Sold'){
          $displayStatus = 'Verkocht';
        }
        echo '<option value="'.$statuses[$i].'" '.$checked.'>'.$displayStatus.'</option>';
      }
      ?>
    </select>
  </div>
  <div class="col-md-4 col-md-offset-3">
    <div class='row col-md-12 changeTitle'>Toepassen</div>
    <button class="row col-md-12 changeItem">Toepassen</button>
  </div>
  <?php
}
?>
<script>
$('.changeItem').click(function(){
  var info = {};
  info.action = 'changeItem';
  info.item = <?= $_POST['item'] ?>;
  info.status = $("#changeItemStatus").val();
  function onComplete(data){
    $('.selectItems').html(data.responseText);
    $('.selectItems').val(info.item);
  }
  parseAjaxReturn(info, onComplete, '../ajaxParses.php');
});
</script>
