 <div class='row col-md-6 changeTitle'>Product Attributen</div>
 <div class='col-md-6 row'>
 <select class="" id="amountOfAttributes">
         <?php
         for($i = 1; $i <= 40; $i++){
           if($i == 1){
             echo "<option value='{$i}'> {$i} attribuut </option>";
           }
           else{
             echo "<option value='{$i}'> {$i} attributen </option>";
           }
         }
         ?>
 </select>
 <small id="amountOfAttributesHelp" class="form-text text-muted">Selecteer hoeveel attributen u wilt.</small>
 </div>
 <div class='attributeWrapperOuter'>
<?php
require('../db_connect.php');
require('../functions.php');
session_start();
$query = "SELECT attribute, attributeValue FROM ProductAttributes WHERE productID = {$_POST['productID']}";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = 0;
foreach($result as $row){
  $count++;
  ?>
  <div class='attributeWrapperInner row' name='attributeWrapperInner_<?=$count?>'>
    <input type='text' id='attributeInner' value='<?= $row['attribute'] ?>' name='attributeInner_<?=$count?>' class='col-md-4 col-md-offset-1 attributeInner' >
    <input type='text' id='attributeValueInner' value='<?= $row['attributeValue'] ?>'name='attributeValueInner_<?=$count?>' class='col-md-4 col-md-offset-1 attributeValueInner'>
    <button class='col-md-1' id='emptyButtonBtn'>Leeg</button>
  </div>
  <?php
}
 ?>
 </div>
<script>
function attributeHTML2(amount){
  var htmlstring = "<div class='attributeWrapperInner row' name='attributeWrapperInner_"+amount+"'><input type='text' id='attributeInner' value='' name='attributeInner_"+amount+"' class='col-md-4 col-md-offset-1'><input type='text' id='attributeValueInner' value='' name='attributeValueInner_"+amount+"' class='col-md-5 col-md-offset-1'></div>";
  return htmlstring;
}
$("#amountOfAttributes").val('<?= $count ?>');
$("#amountOfAttributes").change(function(){
  var currentAmountOfInputs = $(document).find(".attributeWrapperInner").length;
  var amountOfAttributes = $(this).val();
  if(amountOfAttributes > currentAmountOfInputs){
    for(var i = currentAmountOfInputs + 1; i <= amountOfAttributes; i++){
      $(".attributeWrapperOuter").append(attributeHTML2(i));
    }
  }
  else if(currentAmountOfInputs > amountOfAttributes){
    var toBeRemoved = [];
    for(var i = 0; i <= currentAmountOfInputs; i++){
      if(i > amountOfAttributes && i <= currentAmountOfInputs){
        toBeRemoved[toBeRemoved.length] = i;
      }
    }
    for(var i = 0; i < toBeRemoved.length; i++){
      $("[name='attributeWrapperInner_"+ toBeRemoved[i] +"']").remove();
    }
  }
});

//This is a function to clear the attribute and attribute value field on the click of a button
$( document ).on( "click", "#emptyButtonBtn", function(){
  $(this).parents().find("#attributeInner").val("");
  $(this).parents().find("#attributeValueInner").val("");
});
</script>
