<div class='manageProductsInner'>
  <select class="selectProduct col-md-4 col-md-offset-4">
  </select>
  <div class='productInformationChange col-md-10 col-md-offset-1'>
  </div>
</div>
<script>
$(".selectProduct").load('ajaxGets/manageProductsGetProducts.php');
$(".manageProducts").click(function(){
  $(".selectProduct").load('ajaxGets/manageProductsGetProducts.php');
});

$(".selectProduct").change(function(){
  var info = {};
  info.product = $(this).val();
  function onComplete(data){
    $(".productInformationChange").html(data.responseText);
    function onCompleteInner(data){
      $('.selectItems').html(data.responseText);
    }
    var infoInner = {};
    infoInner.productID = info.product;
    parseAjaxReturn(infoInner, onCompleteInner, 'ajaxGets/manageProductsGetItems.php');


    function onCompleteInner2(data){
      $('.attributeWrapper2').html(data.responseText);
    }
    var infoInner2 = {};
    infoInner2.productID = info.product;
    parseAjaxReturn(infoInner2, onCompleteInner2, 'ajaxGets/manageProductsGetAttributes.php');


    function onCompleteInner3(data){
      $('.imageWrapper').html(data.responseText);
    }
    var infoInner3 = {};
    infoInner3.product = info.product;
    parseAjaxReturn(infoInner3, onCompleteInner3, 'ajaxGets/manageProductsGetImages.php');


    function onCompleteInner4(data){
      $('.addImageWrapper').html(data.responseText);
    }
    var infoInner4 = {};
    infoInner4.product = info.product;
    parseAjaxReturn(infoInner4, onCompleteInner4, 'ajaxGets/manageProductsAddImages.php');


  }
  parseAjaxReturn(info, onComplete, 'ajaxGets/manageProductsGetProductInfo.php');


});
$(document).on('click','.selectItems',function(){
  console.log('click');
  function onCompleteInner(data){
    $('.selectItems').html(data.responseText);
  }
  var infoInner = {};
  infoInner.productID = $(".selectProduct").val();
  parseAjaxReturn(infoInner, onCompleteInner, 'ajaxGets/manageProductsGetItems.php');
});
$(document).on('click', ".imageInformationWrapper button", function(){
    var info = {};
    info.product = $(this).parent().attr('product');
    info.image = $(this).siblings('img').attr('src');
    info.action = 'removeImage';
    function onComplete(data){
        function onCompleteInner3(data){
          $('.imageWrapper').html(data.responseText);
        }
        var infoInner3 = {};
        infoInner3.product = info.product;
        parseAjaxReturn(infoInner3, onCompleteInner3, 'ajaxGets/manageProductsGetImages.php');
    }
    parseAjax(info, onComplete);
    console.log(info);
});

  var imageCount = 1;
  var ImageNumber = 2;

  //This is a function to change the background image of the image input to whatever you selected.
  $( document ).on( "click drop", "#fileToUpload", function() {
    var scope = this;
    $(this).change(function(event){
        var images = document.getElementsByClassName("fileUpload");
        var input = event.target;
        var image = $(input).siblings("#formImage");
        var reader = new FileReader();
        if($(image).attr('src') == ""){
            $(".addImageWrapper").append('<div id="fileUpload" class="fileUpload col-md-2">  <i id="removeImage" class="fa fa-times" style="font-size: 18px;" aria-hidden="true"></i>  <img src="" id="formImage">    <i id="uploadIcon" class="fa fa-upload fa-9x" aria-hidden="true" ></i>    <p id="uploadImageText">Select or drag your image into this box</p>    <input type="file" name="fileToUpload_' + ImageNumber +'" id="fileToUpload" class="fileToUpload" value="Choose Image">  </div>');
            ++imageCount;
            ++ImageNumber;
        }
        reader.onload = function(){
          var dataURL = reader.result;
          $(image).attr("src", dataURL);
        };
        reader.readAsDataURL(input.files[0]);
        $(this).siblings("#uploadImageText").hide();
        $(this).siblings("#uploadIcon").hide();
        $(this).siblings("#removeImage").show();
    });
  });
  for(var i = 0; i < $(".fileUpload").length; i++){
    if($(".fileUpload:eq("+i+")").find('img').attr('src') != ""){
      $(".fileUpload:eq("+i+")").find("#uploadImageText").hide();
      $(".fileUpload:eq("+i+")").find("#uploadIcon").hide();
      $(".fileUpload:eq("+i+")").find("#removeImage").show();
    }
  }
  $("#fileToUpload").change(function(){
    var imageHeight = $(this).siblings("#formImage").css("height");
    var remainingSpace = $(this).parents().height() - imageHeight;
    $("#formImage").css({"margin-top": remainingSpace / 2});
  });
  //This function either deletes the image upload entirely if there is more than 1 or just clears it out if there is only a single image upload.
  $( document ).on( "click", "#removeImage", function() {
    var scope = $(this);
    if(imageCount > 1){
      $(this).parents("#fileUpload").remove();
      --imageCount;
    }
    else{
      $(this).siblings("#fileToUpload").val(null);
      $(this).siblings("#formImage").attr('src', null);
      $(this).siblings("#uploadIcon").show();
      $(this).siblings("#uploadImageText").show();
    }
  });

  $(document).on('click', '.addImageContainer button', function(e){
    e.preventDefault();
    var info = new FormData(document.getElementById('addImageWrapper'));
    info.append('action', 'addImages');
    info.append('product', $('.selectProduct').val());
    info.append('lastImage', ImageNumber);
    // info.action = 'addImages';
    // info.product = $('.selectProduct').val();
    console.log(info);
    for (var pair of info.entries()) {
      console.log(pair[0]+ ', ' + pair[1]);
    }
    function onComplete(data){
      function onCompleteInner3(data){
        $('.imageWrapper').html(data.responseText);
      }
      var infoInner3 = {};
      infoInner3.product = $('.selectProduct').val();
      parseAjaxReturn(infoInner3, onCompleteInner3, 'ajaxGets/manageProductsGetImages.php');
    }
    parseAjax_FormData(info, onComplete);
  });
</script>
