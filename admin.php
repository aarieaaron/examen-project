<?php
if(hasRole("admin")){
  ?>
  <div class="container col-md-12">
    <div class="row actionNavbar">
      <button class="col-md-2 col-sm-3 manageUsers">Beheer Klanten</button>
      <button class="col-md-2 col-sm-4 productSale">Product Van De Dag</button>
      <button class="col-md-40px exitAdmin exitProducts"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>
    <div class="row adminContent">
      <?php
      if(isset($_GET['function']) && $_GET['function'] == 'manage_users'){
        $display = 'inline';
      }
      else{
        $display = 'none';
      }
      ?>
      <div class="manageUsersContent" style='display: <?=$display?>'>
        <h3 class="col-md-12">Beheer Klanten.</h3>
        <select class='chooseUser'>
        </select>
        <div class='changeUserInformation'>
        </div>
      </div>

        <?php
        if(isset($_GET['function']) && $_GET['function'] == 'product_sale'){
          $display = 'inline';
        }
        else{
          $display = 'none';
        }
        ?>
      <div class='productSaleContent' style='display: <?=$display?>'>
        <h3 class="col-md-12">Kies een product van de dag.</h3>
        <?php require('productOfTheDay.php') ?>
      </div>
      <?php
      if(!isset($_GET['function'])){
        $display = 'inline';
      }
      else{
        $display = 'none';
      }
      ?>
      <div class="defaultMessageContent" style='display: <?=$display?>'>
        <h2>Klik op een knop om een actie uit te voeren.</h2>
      </div>
    </div>
  </div>
  <?php
}
?>
<script>
$(".chooseUser").load('ajaxGets/manageUsersGetUsers.php');
var $_POST = <?php echo json_encode($_POST); ?>;
$(document).on('change',".chooseUser",function(){
  var info = {};
  info.user = $(this).val();
  function onComplete(data){
    $(".changeUserInformation").html(data.responseText);
  }
  parseAjaxReturn(info, onComplete, 'ajaxGets/manageUsersGetUserinfo.php');
})

$(document).on('click', '.addRole', function(){
  var info = {};
  info.userID = $(".chooseUser").val();
  info.role = $('.selectedRole').val();
  info.action = 'addRole';
  function onComplete(data){
    var info2 = {};
    info2.user = info.userID;
    function onComplete(data){
      $('.roles').html(data.responseText);
    }
    parseAjaxReturn(info2, onComplete, 'ajaxGets/manageUsersGetRoles.php')
  }
  parseAjax(info, onComplete);
});
$(document).on('click', '.saveChanges', function(){
  var info = {};
  info.action = 'changeUser';
  info.userID = $(".chooseUser").val();
  info.name = $("#nameInput").val();;
  info.paymentMethod = $(".paymentMethod").val();;
  info.bank = $(".selectedBank").val();;
  info.password = $("#passwordInput").val();;
  info.email = $("#emailInput").val();;
  info.status = $(".accountStatus").val();
  function onComplete(data){
    $("#feedbackText").html(data.responseText);
  }
  parseAjax(info, onComplete);
});
switchAction(".manageUsers", ".manageUsersContent");
switchAction(".exitAdmin", ".defaultMessageContent");
switchAction(".productSale", ".productSaleContent");
</script>
