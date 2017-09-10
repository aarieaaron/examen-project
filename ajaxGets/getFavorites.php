<?php
require('../db_connect.php');
require('../functions.php');
session_start();

$query = "SELECT count(productID) as count FROM Favorites WHERE userID = {$_SESSION['userinfo']['userID']}";
$result = mysqli_query($connection, $query);
foreach($result as $row){
  echo $row['count']." PRODUCT(EN) IN UW FAVORIETEN";
}
 ?>
 <script>
 $.getScript("functions.js");
 $(".addFromFavoritesToCart").click(function(){
   var data = {};
   data.action = "addFromFavoritesToCart";
   data.productID = $(this).attr('id');
   function onComplete(data){
     $(".favoriteItems").load("ajaxGets/getFavorites.php");
     $(".cartItems").load("ajaxGets/getCart.php", function(){
       countDown($(document).find("#lastModified").val());
     });
   }
   parseAjax(data, onComplete);
 });

 $(".removeFromFavorites").click(function(){
   var data = {};
   data.action = "removeFromFavorites";
   data.productID = $(this).attr('id');
   function onComplete(data){
     $(".favoriteItems").load("ajaxGets/getFavorites.php");
   }
   parseAjax(data, onComplete);
 });
 </script>
