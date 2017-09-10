
<div class="shoppingCart row">
  <a href="index.php?content=cart"><h4> Winkel Mandje </h4></a>
  <div class="cartItems">
    <!-- Loads from ajaxGets/getCart.php -->
  </div>
  <h4 id="timeRemaining"> </h4>
</div>
<div class="statusText"></div>
<script>
$(".cartItems").load("ajaxGets/getCart.php", function(){
  console.log("test");
  countDown($(document).find("#lastModified").val());
});
</script>
