<div class='manageBrandsInner'>
  <select class="selectBrand col-md-4 col-md-offset-4">
  </select>
  <div class='brandInformationChange col-md-10 col-md-offset-1'>
  </div>
</div>
<script>
$(".selectBrand").load('ajaxGets/manageBrandsGetBrands.php');
$(".manageBrands").click(function(){
  $(".selectBrand").load('ajaxGets/manageBrandsGetBrands.php');
});
$(".selectBrand").change(function(){
  var info = {};
  info.brand = $(this).val();
  function onComplete(data){
    $(".brandInformationChange").html(data.responseText);
  }
  parseAjaxReturn(info, onComplete, 'ajaxGets/manageBrandsGetBrandInfo.php');


});
$(document).on('click', '.saveWorkBrand', function(){
    var info = {};
    info.brand = $(".selectBrand").val();
    info.action = "updateBrand";
    info.description = $("#brandDescriptionInput").val();
    function onComplete(data){
      $("#brandFeedback").html(data.responseText);
    }
    parseAjax(info, onComplete);
});
</script>
