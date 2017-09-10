<div class="col-md-10 col-md-offset-1 registrationInner">
  <div class='registrationStage1'>
    <div class="registrationFormInner col-md-8">
      <div class="registerForm  col-md-8" id="registerForm">
        <h2 class="">Informatie</h2>
        <div class="registerFormInner">
          <div class="row registerInput">
            <h5> Voornaam </h5>
            <input type="text" class="col-md-8 col-md-offset-2 firstnameInput" name="firstname" id="firstname" value="">
          </div>
          <div class="row registerInput">
            <h5> Achternaam </h5>
            <input type="text" class="col-md-8 col-md-offset-2 lastnameInput" name="surname" id="surname" value="">
          </div>
          <div class="row registerInput">
            <h5> Email </h5>
            <input type="email" class="col-md-8 col-md-offset-2 emailInput" name="email" id="email" value="">
          </div>
          <div class="row registerInput">
            <h5> Telefoon Nummer </h5>
            <input type="text" class="col-md-8 col-md-offset-2 phonenumberInput" name="phonenumber" id="phonenumber" value="">
          </div>
          <div class="row registerInput">
            <h5> Wachtwoord </h5>
            <input type="password" class="col-md-8 col-md-offset-2 password passwordInput" name="wachtwoord" id="password" value=""><i class="fa fa-eye" aria-hidden="true" id="showPassword" style="font-size: 32px; position: relative; left: -35px; top: 6px"></i>
          </div>
          <div class="row registerInput">
            <h5> Wachtwoord Herhalen</h5>
            <input type="password" class="col-md-8 col-md-offset-2 password passwordCheckInput" name="wachtwoordCheck" id="passwordCheck" value=""><i class="fa fa-eye" aria-hidden="true" id="showPasswordCheck" style="font-size: 32px; position: relative; left: -35px; top: 6px"></i>
          </div>
        </div>
      </div>
      <button type="submit" id="register" class="col-md-2 col-md-offset-1 registerFormButton" name="register">Registeren</button>
    </div>
    <div class="payment col-md-offset-0 col-md-4">
      <h2 class="">Betaal methode</h2>
      <div class="paymentButtons row">
        <div class="col-md-5 col-md-offset-1 paymentOption" option="ideal"><img class="" src='images/iDeal.gif'><h5>iDeal</h5></div>
        <div class="col-md-5 col-md-offset-1 paymentOption" option="paypal"><img class="" src='images/paypal.png'><h5>Paypal</h5></div>
        <div class="col-md-5 col-md-offset-1 paymentOption" option="bank"><img class="" src='images/bank.ico'><h5>Overmaken</h5></div>
        <div class="col-md-5 col-md-offset-1 paymentOption" option="cash"><img class="" src='images/money.png'><h5>Aan de deur</h5></div>
      </div>
      <div class="paymentSelect row">
        <div class="iDealSelect selectedOption" selected='ideal'>
          <div class="iDealOption col-md-11 col-md-offset-1" bank="ING"><input type="checkbox" class="selectOption"><img class="bankIcon" src='images/ing.gif'><h5>ING</h5></div>
          <div class="iDealOption col-md-11 col-md-offset-1" bank="ABN_AMRO"><input type="checkbox" class="selectOption"><img class="bankIcon" src='images/abnamro2.png'><h5>ABN AMRO</h5></div>
          <div class="iDealOption col-md-11 col-md-offset-1" bank="RABO"><input type="checkbox" class="selectOption"><img class="bankIcon" src='images/rabobank.png'><h5>RABO BANK</h5></div>
          <div class="iDealOption col-md-11 col-md-offset-1" bank="SNS"><input type="checkbox" class="selectOption"><img class="bankIcon" src='images/sns.png'><h5>SNS</h5></div>
        </div>
        <div class="bankSelect selectedOption" selected='bank'>
          <h5 class='col-md-offset-1'>U heeft geld overmaken geselecteerd.</h5>
          <h5 class='col-md-offset-1'>Bij het bestellen krijgt u verdere instructies.</h5>
        </div>
        <div class="cashSelect selectedOption" selected='cash'>
          <h5 class='col-md-offset-1'>U heeft aan de deur betalen geselecteerd.</h5>
          <h5 class='col-md-offset-1'>Bij het bestellen krijgt u verdere instructies.</h5>
        </div>
        <div class="paypalSelect selectedOption" selected='paypal'>
          <h5 class='col-md-offset-1'>U heeft PayPal geselecteerd.</h5>
          <h5 class='col-md-offset-1'>Bij het bestellen krijgt u verdere instructies.</h5>
        </div>
      </div>
    </div>
  </div>
  <div class='registrationConfirmation'>
    <h4 id="feedbackRegistration"></h4>
  </div>
</div>
<script>
var currentOption = "";
var paymentOption = "";
var iDealOption = "";
$(".paymentOption").click(function(){
  if(currentOption != this){
    selectedPayment = false;
    if(selectedPayment == true && passwordCheck == true){
      $("#register").show();
      allowProgress = true;
    }
    else{
      $("#register").hide();
      allowProgress = false;
    }
  }
  currentOption = this;
  paymentOption = $(this).attr('option');
  $(this).animate({'background-color': '#50B746'}, 200);
  $(this).siblings().animate({'background-color': '#287BB2'}, 200);
  if($(this).attr('option') == 'ideal'){
    $(".iDealSelect").show();
    $(".paypalSelect").hide();
    $(".cashSelect").hide();
    $(".bankSelect").hide();
    $(".iDealOption").click(function(){
      iDealOption = $(this).attr('bank');
      selectedPayment = true;
      if(selectedPayment == true && passwordCheck == true){
        $("#register").show();
        allowProgress = true;
      }
      else{
        $("#register").hide();
        allowProgress = false;
      }
      $(this).animate({'background-color': '#50B746'}, 200);
      $(this).siblings().animate({'background-color': '#287BB2'}, 200);
      $(this).children('input[type="checkbox"]').prop('checked', true);
      $(this).siblings().children('input[type="checkbox"]').prop('checked', false);
    });
  }
  else if($(this).attr('option') == 'paypal'){
      $(".paypalSelect").show();

      $(".iDealSelect").hide();
      $(".cashSelect").hide();
      $(".bankSelect").hide();
      $(".iDealOption").animate({'background-color': '#287BB2'},1);
      $(".iDealOption").children('input[type="checkbox"]').prop('checked', false);

      selectedPayment = true;
      if(selectedPayment == true && passwordCheck == true){
        $("#register").show();
        allowProgress = true;
      }
      else{
        $("#register").hide();
        allowProgress = false;
      }
  }

  else if($(this).attr('option') == 'bank'){
      $(".bankSelect").show();

      $(".iDealSelect").hide();
      $(".paypalSelect").hide();
      $(".cashSelect").hide();
      $(".iDealOption").animate({'background-color': '#287BB2'},1);
      $(".iDealOption").children('input[type="checkbox"]').prop('checked', false);

      selectedPayment = true;
      if(selectedPayment == true && passwordCheck == true){
        $("#register").show();
        allowProgress = true;
      }
      else{
        $("#register").hide();
        allowProgress = false;
      }
  }
  else if($(this).attr('option') == 'cash'){
      $(".cashSelect").show();

      $(".iDealSelect").hide();
      $(".paypalSelect").hide();
      $(".bankSelect").hide();
      $(".iDealOption").animate({'background-color': '#287BB2'},1);
      $(".iDealOption").children('input[type="checkbox"]').prop('checked', false);

      selectedPayment = true;
      if(selectedPayment == true && passwordCheck == true){
        $("#register").show();
        allowProgress = true;
      }
      else{
        $("#register").hide();
        allowProgress = false;
      }
  }
  else{
  }
});
</script>
