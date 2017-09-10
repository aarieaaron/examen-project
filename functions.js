/*This file houses all of the functions used in this project.
  It excludes any jQuery functions that are called used like '$(".element").click(function(){});' as they are page specific*/


//This function is used to parse data to a PHP file asynchronously.
//This function takes 2 arguments, the data object that needs to be parsed and the function it has to execute on completion of the POST.
function parseAjax(info, func) {
  $.ajax({
    url: "ajaxParses.php",
    type: "POST",
    dataType: "json",
    data: $.param(info),
     complete: function(data){
      if (data) {
        func(data);
      }
  }});
}
//EndFunction

//This function is used to parse data to a PHP file asynchronously.
//This function takes 3 arguments, the data object that needs to be parsed, the function it has to execute on completion of the POST and the target of the POST.
function parseAjaxReturn(info, func, target) {
  $.ajax({
    url: target,
    type: "POST",
    dataType: "json",
    data: $.param(info),
     complete: function(data){
      if (data) {
        func(data);
      }
  }});
}
//EndFunction

function parseAjax_FormData(info, func){

  $.ajax({
    type: "POST",
    url: "ajaxParses.php",
    data: info,
    dataType: "json",
    processData: false,
    contentType: false,
    complete: function (data) {
        func(data);
    }
  });
}

//This function would be used to change the background image when you upload an image but is no longer useful, this is just here for backup reasons.
var openFile = function(event) {
  var input = event.target;

  var reader = new FileReader();
  reader.onload = function(){
    var dataURL = reader.result;
    var output = $(input).siblings("#formImage");
    output.src = dataURL;
  };
  reader.readAsDataURL(input.files[0]);
  $(input).siblings("#uploadImageText").hide();
  $(input).siblings("#uploadIcon").hide();

};
//EndFunction

//This function sets the height of the sidebars to be the same height as that of the .content div;
function resizeSidebars(){
    var height = $(".content").css("height");
    $(".sidebar").css({"height": height});
}
//EndFunction

//This function is used to switch between hidden content by the press of a specific button.
//This function takes 2 arguments, the first is the button to be pressed, the second the wrapper of whatever you wish to show;
function switchAction(button, content){
  $(button).click(function(){
    $(content).siblings().hide();
    $(content).show();
    if(button != ".exitProducts"){$(button).css({"border-bottom": "2px solid blue"});}
    $(button).siblings().css({"border-bottom": "0px solid blue"});
    if(button == ".manageProducts"){
        history.pushState(null, null, "/medewerker/manage_products");
    }
    else if(button == ".manageBrands"){
        history.pushState(null, null, "/medewerker/manage_brands");
    }
    else if(button == ".addProducts"){
        history.pushState(null, null, "/medewerker/add_products");
    }
    else if(button == ".expiredProducts"){
        history.pushState(null, null, "/medewerker/expired_products");
    }
    else if(button == ".exitProducts"){
        history.pushState(null, null, "/medewerker");
    }
    else if(button == ".manageUsers"){
        history.pushState(null, null, "/admin/manage_users");
    }
    else if(button == ".exitAdmin"){
        history.pushState(null, null, "/admin");
    }
    else if(button == ".productSale"){
        history.pushState(null, null, "/admin/product_sale");
    }
  });
}
//Function to get a random number between 2 values,
//Found on http://stackoverflow.com/questions/4959975/generate-random-number-between-two-numbers-in-javascript
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}
function displayTime(lastModifiedDate, interval){
  var now = new Date();
  var difference =  now - lastModifiedDate;
  var secDif = difference / 1000;
  var countingDown = Math.floor(1800 - secDif);
  var minutes = Math.floor(countingDown / 60);
  var seconds = Math.floor(countingDown % 60);
  var displaySeconds = "";
  var displayMinutes = "";
  if(seconds == 60){
    displaySeconds = "00";
    displayMinutes = minutes + 1;
  }
  else{
    displaySeconds = seconds;
    displayMinutes = minutes;
  }
  if(seconds < 10){
    displaySeconds = "0" + seconds;
  }
  if(minutes == 0){
    displayMinutes = "00";
  }
  if(countingDown <= 0){
    var data = {};
    data.action = "emptyCart";
    function onComplete(data){
      $("#timeRemaining").html("00:00");
      $(".cartItems").load('ajaxGets/getCart.php');
      $(".cartContainer").load('ajaxGets/getCheckoutCart.php');
      $(".stage_2Cart").html("");
      window.clearInterval(interval);
    }
    parseAjax(data, onComplete);
  }
  else{
    $("#timeRemaining").html(displayMinutes +":"+ displaySeconds);
  }
  if(typeof lastModifiedDate === 'undefined'){
    $("#timeRemaining").html("00:00");
  }
}
function countDown(time){
  var interval;
  var lastModifiedDate = new Date(time * 1000);
  displayTime(lastModifiedDate, interval);
  interval = setInterval(function(){
    $(".changeCart").click(function(){
      console.log('changing cart');
      if(window.clearInterval(interval)){
        console.log("clearing interval");
      }
    });
    displayTime(lastModifiedDate, interval);
  }, 1000);
}




jQuery.fn.rotate = function(degrees) {
    $(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
    return $(this);
};
