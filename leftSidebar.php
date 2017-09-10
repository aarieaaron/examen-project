<?php
if(isset($_SESSION['userinfo']['userID'])){
  ?>
  <div class="favorites row">
   <a href="index.php?content=cart"><h4> Favorieten </h4></a>
   <div class="favoriteItems">
     <!-- Loads from ajaxGets/getFavorites.php -->
   </div>
  </div>
  <?php
}
 ?>
 <div class="categoryWrapper row">
   <div class="category row" shown='false'>
     <h3><span class='arrow'><i class="fa fa-caret-right" aria-hidden="true"></i></span>Fietsen</h3>
     <div class="subcategory" category="omafiets"><h4>Omafiets</4></div>
     <div class="subcategory" category="opafiets"><h4>Opafiets</h4></div>
     <div class="subcategory" category="moederfiets"><h4>Moederfiets</h4></div>
     <div class="subcategory" category="mountainbike"><h4>Mountain Bike</h4></div>
   </div>
   <div class="category row" shown='false'>
     <h3><span class='arrow'><i class="fa fa-caret-right" aria-hidden="true"></i></span>Kinder Fietsen</h3>
     <div class="subcategory" category="Jongens Fiets"><h4>Jongens Fiets</h4></div>
     <div class="subcategory" category="meisjesfiets"><h4>Meisjes Fiets</h4></div>
   </div>
   <div class="category row" shown='false'>
     <h3><span class='arrow'><i class="fa fa-caret-right" aria-hidden="true"></i></span>Onderdelen</h3>
     <div class="subcategory" category="achterlampen"><h4>Achterlampen</h4></div>
     <div class="subcategory" category="voorlampen"><h4>Voorlampen</h4></div>
     <div class="subcategory" category="binnenband"><h4>Binnenbanden</h4></div>
   </div>
   <div class="category row" shown='false'>
     <h3><span class='arrow'><i class="fa fa-caret-right" aria-hidden="true"></i></span>Accessoires</h3>
     <div class="subcategory" category="fietstas"><h4>Fietstassen</h4></div>
     <div class="subcategory" category="voordrager"><h4>Voordragers</h4></div>
     <div class="subcategory" category="snelbinders"><h4>Snelbinders</h4></div>
   </div>
 </div>
<script>
console.log(document.URL.substring(56));
$(".category h3").click(function(){
  if($(this).parent().attr('shown') == 'false'){
    $(this).parent().find(".fa-caret-right").rotate("90");
    $(this).parent().attr('shown', 'true');
    $(this).parent().find('div').show();
  }
  else if($(this).parent().attr('shown') == 'true'){
    $(this).parent().find(".fa-caret-right").rotate("0");
    $(this).parent().attr('shown', 'false');
    $(this).parent().find('div').hide();
  }
});
$(".subcategory").mouseover(function(){
  $(this).animate({backgroundColor: "rgba(255,255,255, 0.3)"}, 50);
}).mouseleave(function(){
  $(this).animate({backgroundColor: "rgba(255,255,255, 0)"}, 50);
});
$(".subcategory").click(function(){
  if(currentPage == 'category'){
    //ajaxparse stuff here
  }
  else{
    window.location.href = 'category/' + $(this).attr('category');
  }
})
$(".addFromFavoritesToCart").click(function(){
  if($(this).attr('disabled') == 'disabled'){
    $(".cartContainer").load('ajaxGets/getCheckoutCart.php');
    console.log("disabled");
  }
  else{
    console.log("not disabled");
  }
});
$.getScript("functions.js");
$(".favoriteItems").load("ajaxGets/getFavorites.php");
</script>
