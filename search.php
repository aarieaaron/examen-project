<script>
var imageArray = [];
</script>
<div class="searchWrapper">
 <div class="advancedSearchbar">
   <div class="searchInput  col-md-6 col-md-offset-2">
     <?php
     if(isset($_GET['query'])){
       $search = str_replace('_', ' ', $_GET['query']);
       echo '<form id="searchForProducts"><input type="text" class="form-control" value="'.$search.'" id="bigSearchBar">';
     }
     else{
       echo '<form id="searchForProducts"><input type="text" class="form-control" value="" id="bigSearchBar">';
     }
   ?>
   </div>
   <div class="searchFilter col-md-2">
     <select class="form-control searchFilterSelect">
       <?php if(isset($_GET['filter'])){ ?>
       <option value="productID" <?=$_GET['filter'] == 'productID' ? ' selected="selected"' : '';?>>Automatisch</option>
       <option value="productPrice" <?=$_GET['filter'] == 'productPrice' ? ' selected="selected"' : '';?>>Prijs</option>
       <option value="productName" <?=$_GET['filter'] == 'productName' ? ' selected="selected"' : '';?>>Naam</option>
       <?php }else{?>
       <option value="productID">Automatisch</option>
       <option value="productPrice">Prijs</option>
       <option value="productName">Naam</option>
       <?php }?>
     </select>
   </div>
   <div class="submitButton">
     <button type="submit" class="btn btn-primary bigSearchButton">Zoek</button></form>
   </div>
 </div>
 <div class="searchResults">
<?php
if(isset($_GET['query']) && $_GET['query'] != ""){
  $search = str_replace('_', ' ', $_GET['query']);
  $properSearch = "%".$search."%";
  if($getProducts = mysqli_prepare($connection, "SELECT distinct (p.productID), productName, productPrice FROM Product as p, ProductAttributes as pa WHERE p.productID = pa.productID AND (p.productName LIKE ?  OR pa.attributeValue LIKE ? OR pa.attribute LIKE ?);")){
    mysqli_stmt_bind_param($getProducts, 'sss', $properSearch, $properSearch, $properSearch);
    mysqli_stmt_execute($getProducts);
    mysqli_stmt_bind_result($getProducts, $productID, $productName, $productPrice);
    $numRows = prepared_num_rows($getProducts);
    if($numRows == 0){
      echo "<h3 class='row col-md-12' style='text-align: center'> geen resultaten voor &#39;" .$search."&#39;</h3>";
    }
    else if($numRows == 1){
      echo "<h3 class='row col-md-12' style='text-align: center'> ". $numRows . " resultaat voor &#39;" .$search."&#39;</h3>";
    }
    else{
      echo "<h3 class='row col-md-12' style='text-align: center'> ". $numRows . " resultaten voor &#39;" .$search."&#39;</h3>";
    }
    while(mysqli_stmt_fetch($getProducts)){
      ?>
      <a href="<?= "index.php?content=product&id=".$productID ?>"><div id="<?=$productID?>" name="<?=$productID?>" class="searchItem col-md-8 col-md-offset-2">
        <?php if($getPicture = mysqli_prepare($connection2, "SELECT image from ProductImages WHERE productID = ?")){
          mysqli_stmt_bind_param($getPicture, 'i', $productID);
          mysqli_stmt_execute($getPicture);
          mysqli_stmt_bind_result($getPicture, $image);
          $numRows = prepared_num_rows($getPicture);
          $rowCount = 0;
          while(mysqli_stmt_fetch($getPicture)){
            $rowCount++;
            if($rowCount == 1){
                echo '<img class="col-md-3 searchItemInfo" id="searchItemInfo" src="'.$image.'">';
            }
            ?><script>

            imageArray[imageArray.length] =  {productID: <?= $productID?>, Image: "<?= $image ?>"};</script> <?php
          }
        }?>
        <div class="col-md-8 searchItemInfoInner">
          <p class="row"><?= $productName ?></p>
          <p class="row"><?= "&#8364;".$productPrice?> </p>
        </div>
      </div></a>
      <?php
    }
  }
}
else{
  echo "<h3 class='row col-md-12' style='text-align: center'> Gebruik de zoek balk om naar producten te zoeken </h3>";
}
 ?>
 </div>
</div>
<script>
$(".searchItem").mouseenter(function(){
  var that = $(this);                                                                     //Creates context for use within the setInterval function.
  var id = $(this).attr('id');                                                            //Creates the id variable and sets it to be equal to the id of the product the user is hoveing over.
  var properArray = [];                                                                   //Creates an empty array.
  //Loops through all of the images loaded with the products.
  for(var i = 0; i < imageArray.length; i++){
    //Checks if the productID associated with the image is the same as the productID given to the element the user is hovering over.
    if(imageArray[i].productID == id){
      properArray[properArray.length] = imageArray[i].Image;                              //Sets properArray to the image it found in the imageArray, the index being it's own length as that counts up automatically.
    }
  }
  var counter = 0;                                                                        //Creates the counter to be used in the setInterval function.
  var ImageCounter = 0;                                                                   //Creates the imageCounter to be used to determine which image is loaded next.
  //Set var interval to the setInterval function using 1000ms steps making it an accurate counter
  var interval = setInterval(function () {
    ++counter;                                                                            //Increase counter by one.
    //Counts every 2 seconds
    if(counter % 2 == 0){
      ++ImageCounter;                                                                     //Increases imageCounter by one.
      var currentImage = ImageCounter % properArray.length;                               //Makes it so that the imageCounter variable cannot be higher than the length of the array, instead looping back around to 0.
      $(that).find(".searchItemInfo").attr('src', properArray[currentImage]);             //Change current image to whatever the array returns with the index currentImage.
    }
  }, 1000);
  //Unsets the interval whenever you remove the mouse from the element.
  $(this).mouseleave(function(){
    var counter = 0;                                                                      //Resets counter to one !NOTE_TO_SELF(Might want to rethink doing this in general, but I can live with it for now)!.
    clearInterval(interval);                                                              //Clears the interval.
  });
});

//Function to be executed on submit of the #searchForProducts form.
$("#searchForProducts").submit(function(e){
  e.preventDefault();                                                                                               //Stops the form itself from doing it's usual PHP post.
  var data = {};                                                                                                    //Creates empty object.
  data.searchVal = $("#bigSearchBar").val();                                                                        //Sets the searchVal value to be equal to the value of #bigSearchBar.
  data.filter = $(".searchFilterSelect").val();                                                                     //Sets the filter value to be equal to the value of .searchFilterSelect.
  data.action = 'search';                                                                                           //Sets the action value to be equal to 'search'.
  //Oncomplete function to used as the second argument in parseAjax(data, func).
  function onComplete(data){
    $(".searchResults").html(data.responseText);                                                                    //Loads whatever parseAjax(data, func) returns into the .searchResults element.
  }
  $(".searchResults").html("<img src='images/ring.svg' class='col-md-6 col-md-offset-3'style='height: auto;'>");    //Turns the .searchResults html into a loading icon
  //Executes parseAjax function.
  parseAjax(data, onComplete);
  history.pushState(null, null, "/search/" + data.searchVal.replace(' ', '_') + "&filter=" + data.filter);          //Changes the current URL to include '&query=' and '&filter=' with their respective values.
});
</script>
