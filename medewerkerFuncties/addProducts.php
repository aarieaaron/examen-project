<div class="addProductsContentInner">
  <div class="addProductInformation">
    <form id="addProductForm" name="addProductForm">
      <div class='row'>
          <div class="form-group col-md-4 col-md-offset-2 ">
            <label for="productNameInput">Product Naam</label>
            <input type="text" name="productNameInput" class="form-control" id="productNameInput" aria-describedby="productNameHelp" placeholder="">
            <small id="productNameHelp" class="form-text text-muted">Vul hier de naam van het product in.</small>
          </div>
          <div class="form-group col-md-2">
            <label for="productPriceInput">Product Prijs</label>
            <input type="number" step="0.01" name="productPriceInput" class="form-control" id="productPriceInput" aria-describedby="productPriceHelp" placeholder="">
            <small id="producPriceHelp" class="form-text text-muted">Vul hier de prijs van het product in.</small>
          </div>
      </div>
      <div class='row' style='clear: left'>
          <div class="form-group col-md-offset-2 col-md-3">
            <label for="productMerkInput">Product Merk</label>
            <select class="form-control" id="productMerkInput" name="productBrandInput" aria-describedby="productMerkHelp">
            </select>
            <small id="productMerkHelp" class="form-text text-muted">Selecteer hier het merk van het product.</small>
          </div>
          <div class="form-group col-md-6 brandName col-md-offset-2 " style="display: none;">
              <label for="brandNameInput">Merk</label>
              <input type="text" class="form-control" id="brandNameInput" aria-describedby="productNameHelp" placeholder="">
              <small id="productNameHelp" class="form-text text-muted">Vul hier de naam het merk in.</small>
          </div>
          <div class="form-group col-md-4 brandName brandNameButton" style="display: none;">
            <button type="button" class="btn btn-primary addBrand">Voeg merk toe</button>
          </div>
          <div class="brandNamePopup col-md-8 col-md-offset-2" style="display: none; text-align: center; color: #509DC2">
            <h3> Merk toegevoegd </h3>
          </div>
      </div>
      <div class='row'>
          <div class="form-group col-md-offset-2 col-md-3">
            <label for="productCategoryInput">Product Categorie</label>
            <select class="form-control" id="productCategoryInput" name="productCategoryInput" aria-describedby="productCategoryHelp">
            </select>
            <small id="productCategoryHelp" class="form-text text-muted">Selecteer hier het categorie van het product.</small>
          </div>
          <div class="form-group col-md-6 category col-md-offset-2 " style="display: none;">
              <label for="categoryInput">Categorie</label>
              <input type="text" class="form-control" id="categoryInput" aria-describedby="productNameHelp" placeholder="">
              <small id="productNameHelp" class="form-text text-muted">Vul hier de naam het categorie in.</small>
          </div>
          <div class="form-group col-md-4 category categoryButton" style="display: none;">
            <button type="button" class="btn btn-primary addCategory">Voeg categorie toe</button>
          </div>
          <div class="categoryPopup col-md-8 col-md-offset-2" style="display: none; text-align: center; color: #509DC2">
            <h3> Categorie toegevoegd </h3>
          </div>
      </div>
      <div class='row'>
          <div class="form-group col-md-2 col-md-offset-2">
            <label for="productQuantityInput">Aantal Producten</label>
            <input type="number" step="0.01" name="productQuantityInput" class="form-control" id="productQuantityInput" aria-describedby="productQuantityInputHelp" placeholder="">
            <small id="productQuantityInputHelp" class="form-text text-muted">Vul hier het aantal producten in.</small>
          </div>
          <div class="form-group col-md-offset-2 col-md-8">
            <label for="exampleTextarea">Product Omschrijving</label>
            <textarea class="form-control" id="productDescriptionInput" name="productDescriptionInput" rows="3"></textarea>
          </div>
          <div class="attributeWrapper">
            <div class="form-group col-md-4 col-md-offset-2" style="margin-right: 16.6666%">
              <label for="amountOfAttributes">Product Attributen</label>
              <select class="form-control" id="amountOfAttributes" aria-describedby="amountOfAttributesHelp">
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
            <div class="attribute" name="attribute_1">
              <div class="form-group col-md-3 col-md-offset-2 productAttributeWrapper">
                <label for="exampleTextarea">Product Attribuut</label>
                <input type="text" class="form-control" id="productAttribute" name="productAttribute_1" aria-describedby="productAttributeHelp" placeholder="">
                <small id="productAttributeHelp" class="form-text text-muted">Vul hier een attribuut in.</small>
              </div>
              <div class="form-group col-md-offset-0_5 col-md-3 productAttributeValueWrapper" style="margin-right: 16.6666%">
                <label for="exampleTextarea">Product Attribuut waarden</label>
                <input type="text" class="form-control" id="productAttributeValue" name="productAttributeValue_1" aria-describedby="productAttributeValueHelp" placeholder="">
                <small id="productAttributeValueHelp" class="form-text text-muted">Vul hier de waarde van het attribuut in.</small>
              </div>
              <div class="form-group col-md-1 emptyButton">
                <input type="button" class="btn btn-danger" id="emptyButtonBtn" value="Maak Leeg">
              </div>
            </div>
          </div>
            <div class="addImagesWrapper">
              <div class="addImages col-md-offset-2 col-md-8">
                <div id="fileUpload" class="fileUpload col-md-2">
                  <i id="removeImage" class="fa fa-times" style="font-size: 18px;" aria-hidden="true"></i>
                  <img src="" id="formImage">
                  <i id="uploadIcon" class="fa fa-upload fa-9x" aria-hidden="true" ></i>
                  <p id="uploadImageText">Select or drag your image into this box</p>
                  <input type="file" name="fileToUpload_1" id="fileToUpload" class="fileToUplad" value="Choose Image">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary col-md-2 col-md-offset-5" style="margin-top: 15px">Voeg Product Toe</button>
            </form>
      </div>
  </div>
</div>
<script>
$("#productMerkInput").load("ajaxGets/getBrand.php");
$("#productCategoryInput").load("ajaxGets/getCategory.php");
//This is a test function to see if this properly parses a number into the htmlstring
function attributeHTML(amount){
  var htmlstring = '<div class="attribute" name="attribute_'+ amount +'"><div class="form-group col-md-3 col-md-offset-2 productAttributeWrapper"><label for="exampleTextarea">Product Attribuut</label><input type="text" class="form-control" id="productAttribute" name="productAttribute_' + amount + '" aria-describedby="productAttributeHelp" placeholder="">  <small id="productAttributeHelp" class="form-text text-muted">Vul hier een attribuut in.</small></div><div class="form-group col-md-offset-0_5 col-md-3 productAttributeValueWrapper" style="margin-right: 16.6666%"><label for="exampleTextarea">Product Attribuut waarden</label>  <input type="text" class="form-control" id="productAttributeValue" name="productAttributeValue_' + amount + '" aria-describedby="productAttributeValueHelp" placeholder="">  <small id="productAttributeValueHelp" class="form-text text-muted">Vul hier de waarde van het attribuut in.</small>  </div> <div class="form-group col-md-1 emptyButton"><input type="button" class="btn btn-danger" value="Maak Leeg" id="emptyButtonBtn"></div> </div>';
  return htmlstring;
}
//This function is to add input fields on change of the selector
$("#amountOfAttributes").change(function(){
  var currentAmountOfInputs = $(document).find(".attribute").length;
  var amountOfAttributes = $(this).val();
  if(amountOfAttributes > currentAmountOfInputs){
    for(var i = currentAmountOfInputs + 1; i <= amountOfAttributes; i++){
      $(".attributeWrapper").append(attributeHTML(i))
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
      $("[name=attribute_"+ toBeRemoved[i] +"]").remove();
    }
  }
});

//This is a function to clear the attribute and attribute value field on the click of a button
$( document ).on( "click", "#emptyButtonBtn", function(){
  $(this).parents().siblings(".productAttributeWrapper").children("#productAttribute").val("");
  $(this).parents().siblings(".productAttributeValueWrapper").children("#productAttributeValue").val("");
});
//This variable is used to count the amount of images in the addImages container
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
          $(".addImages").append('<div id="fileUpload" class="image_1 col-md-2">  <i id="removeImage" class="fa fa-times" style="font-size: 18px;" aria-hidden="true"></i>  <img src="" id="formImage">    <i id="uploadIcon" class="fa fa-upload fa-9x" aria-hidden="true" ></i>    <p id="uploadImageText">Select or drag your image into this box</p>    <input type="file" name="fileToUpload_' + ImageNumber +'" id="fileToUpload" class="fileToUplad" value="Choose Image">  </div>');
          ++imageCount;
          ++ImageNumber
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
$(window).resize(function(){
  $(".medewerkerContent h3").css({"text-align": "center"});
});


$("#productMerkInput").change(function(){
  var current = $("#productMerkInput").val();
  if(current == "addBrand"){
    $(".brandName").show();
  }
  else{
    $(".brandName").hide();
    $(".brandNamePopup").hide();
  }
});

$("#productCategoryInput").change(function(){
  var current = $("#productCategoryInput").val();
  if(current == "addCategory"){
    $(".category").show();
  }
  else{
    $(".category").hide();
    $(".categoryPopup").hide();
  }
});
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
//This function is for the asynchronous parsing of all of the form data
$("#addProductForm").submit(function(e){
  e.preventDefault();
  var fd = new FormData(document.getElementById("addProductForm"));
  fd.append('action', 'addProduct');
  fd.append('maxImage', ImageNumber);
  for (var pair of fd.entries()) {
    console.log(pair[0]+ ', ' + pair[1]);
  }
  //This function is the be executed once the ajax parse is completed.
  function onComplete(data){
    //Add something here
  }
  var test = "test";
  parseAjax_FormData(fd, onComplete);

});

//This function is for the asynchronous parsing of all of the data associated with adding a new brand.
$(".addCategory").click(function(){
  var fd = {};
  fd.category = $("#categoryInput").val();
  fd.action = "addCategory";
  function onComplete(data){
    $(".categoryName").hide();
    $(".categoryNamePopup").show();
    $("#productCategoryInput").load("ajaxGets/getCategory.php");
  }
  parseAjax(fd, onComplete);
});

$(".addBrand").click(function(){
  var fd = {};
  fd.brand = $("#brandNameInput").val();
  fd.action = "addBrand";
  function onComplete(data){
    $(".brandName").hide();
    $(".brandNamePopup").show();
    $("#productMerkInput").load("ajaxGets/getBrand.php");
  }
  parseAjax(fd, onComplete);
});
</script>
