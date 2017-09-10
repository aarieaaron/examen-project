<!DOCTYPE HTML>
<?php
session_start();                  //Starts the session to be used in further code.
require("db_connect.php");        //The db_connect.php file manages the database connection used in SQL queries.
require("functions.php");         //The functions.php file manages the PHP functions used in this website.
$actual_link = "$_SERVER[REQUEST_URI]";
// Error reporting functions set to off by default but will turn on when I need testing.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['userinfo']['userID'])){
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = "";
  }
  if(!isset($_SESSION['cartProducts'])){
    $_SESSION['cartProducts'] = "";
  }
}
?>
<html>
  <head>
    <!-- Including a CDN for jQuery 2.4.4 and JavaScript plugins, we chose 2.4.4 for compatibility reasons. -->
      <script src="js/jquery-2.2.4.js"> </script>
      <script src="js/jquery-ui.js"> </script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <!-- Metadata and title  -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> Examen </title>
      <!-- <base href="http://examen.aaronvanleijenhorst.xyz/" /> -->
    <!-- Font Awesome css inclusion -->
      <!-- <script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script> -->
      <link rel="stylesheet" href="js/font-awesome.min.css">
    <!-- funtions.js for Javascript/jQuery functions -->
      <script src="functions.js"> </script>
    <!-- Bootstrap -->
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
      <!-- Optional theme -->
      <link rel="stylesheet" href="js/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <!-- Latest compiled and minified JavaScript -->
      <script src="js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Stylesheets for our own style.css and CSS files attached to plugins like jQuery-UI -->
      <link rel="stylesheet" Content-Type="text/css" href="js/jquery-ui.css">
      <link rel="stylesheet" Content-Type="text/css" href="style/style.css">
      <!-- <link rel="stylesheet" type="text/css" href="style/customBootstrap.css"> -->
      <link rel="stylesheet" href="js/jquery.timepicker.min.css">
  </head>
  <body>
    <div class="primaryContainer col-lg-12 col-md-12 col-sm-12 col-xs-12 no-gutter">
      <div class="wrapper">
        <div class="headerContainer row">
          <a href="index.php?content=homepage"><div class="header col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-xs-offset-0 col-sm-offset-0">
            <?php require("header.php"); ?>                        <!-- Include the header -->
          </div></a>
          <div class="navigation row col-lg-10 col-md-10  col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-xs-offset-1 col-sm-offset-0  col-xs-offset-0 no-gutter">
            <a href="index.php?content=bestelinfo&lang=ned"><div class="link col-lg-2 col-sm-2 col-xs-4">
              <b>Bestelinfo</b>
            </div></a>
            <a href="index.php?content=expired-products"><div class="link col-lg-2 col-sm-2 col-xs-4">
              <b>Verlopen artikelen</b>
            </div></a>
            <?php
            if(isset($_SESSION['userinfo']['userID'])){
              ?>
              <a href="index.php?content=logout&url=<?=$actual_link?>"><div class="link col-lg-1 col-sm-2 col-xs-6">
                <b>logout</b>
              </div></a>
              <?php
            }
            else{
              ?>
              <a href="index.php?content=login"><div class="link col-lg-1 col-sm-2 col-xs-6">
                <b>login</b>
              </div></a>
              <?php
            }
            ?>
            <div class="search col-lg-4 col-sm-4 col-lg-offset-2 col-md-offset-4">
              <form id="searchSmall"><input class="col-md-offset-2" type="text" id="searchBar" placeholder="zoek naar een product"><button id="searchSubmit" class="btn btn-primary" type="submit"> zoek </button></form>
            </div>
          </div>
        </div>
        <div class="contentWrapper row">
          <div class="leftSidebar sidebar col-lg-1_5 col-md-2 col-sm-12 hidden-xs col-lg-offset-1 col-md-offset-1 col-xs-offset-0 col-sm-offset-0 col-xs-offset-0">
            <?php require("leftSidebar.php"); ?>                  <!-- Includes the left side bar -->
          </div>
          <div class="content col-lg-7 col-md-6 col-xs-12 col-sm-12 col-lg-offset-0 col-md-offset-0 col-xs-offset-0 col-sm-offset-0 ">
            <?php require("redirect.php"); ?>                     <!-- Includes the redirect page -->
          </div>
          <div class="rightSidebar sidebar col-lg-1_5 col-md-2 hidden-sm hidden-xs col-lg-offset-0 col-md-offset-0 col-xs-offset-0 col-sm-offset-0 col-xs-offset-0">
            <?php require("rightSidebar.php"); ?>                 <!-- Includes the right side bar -->
          </div>
        </div>
        <div class="footerWrapper row">
          <div class="footer col-lg-10 col-md-10  col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-xs-offset-0 col-sm-offset-0">
            <?php require("footer.php"); ?>                       <!-- Include the footer -->
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
var currentPage = document.URL.substring(56);
//This function is called when the window resizes, this will most often be used for bootstrap integration.
$.getScript("functions.js");
$(document).ready(function(){
  resizeSidebars();
})
$(window).resize(function(){
  resizeSidebars();
});
//Not the best way of doing this as it's executed on every click but I haven't managed to find another way.
$(document).click(function(){
  resizeSidebars();
})
$("#searchSmall").submit(function(e){
  e.preventDefault();
  var searchVal = $(this).find("#searchBar").val();
  var replaced = searchVal.replace(' ', '_');
  window.location.href = "index.php?content=search&query="+replaced+"";
});

</script>
