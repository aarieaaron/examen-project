<div class='newProductsContainer'>
  <div class="newProducts row">
  <?php
  $query = "SELECT productID, productName, productPrice FROM Product ORDER BY productID DESC LIMIT 5";
  $result = mysqli_query($connection, $query);
  $count = 0;
  foreach($result as $row){
    $count++;
    $productID = $row['productID'];
    $productName = $row['productName'];
    $productPrice = $row['productPrice'];
    $getImage = "SELECT image from ProductImages  as i, Product as p WHERE i.productID = p.productID AND p.productID = {$productID} ORDER BY image LIMIT 1";
    $getImageResult = mysqli_query($connection, $getImage);
    foreach($getImageResult as $getImageRow){
      $image = $getImageRow['image'];
      if($count == 1){$show = "display: inline";}else{$show = "display: none";}
      ?>
      <a href="index.php?content=product&id=<?=$productID?>" class="newProduct" style="<?= $show ?>" count="<?= $count ?>"><div class="col-md-5">
        <img src="images/newProduct.png" class="col-md-12 newProductBanner" >
        <img src="<?= $image ?>" class="col-md-12"id="newProductImage">
        <p id="newProductInfo"> <?= $productName . " | &#8364;". $productPrice ?></p>
      </div></a>
      <?php
    }
  }
  ?>
    <select class='col-md-3 col-md-offset-3 changeLanguage'>
      <option value=''>Choose a language</option>
      <option value='ned'>Nederlands</option>
      <option value='eng'>Engels</option>
    </select>
  </div>
  <div class='progressBar row'>
  </div>
  <div class='newProductSelectors row'>
    <?php
    for($i = 1; $i <= $count; $i++){
      if($i == 1){$checked = 'checked';}else{$checked = "";}
      echo '<input type="radio" name="productSelector" for="'.$i.'" '.$checked.' class="switchProduct">';
    }

     ?>
   </div>
</div>
<?php
  if(!isset($_GET['lang']) || $_GET['lang'] == 'ned'){
    ?>
    <div class='homepageInfo'>
      <h3 class='row'>Welkom op onze website!</h3>
      <span>
        Hier bij examen.aaronvanleijenhorst.xyz zijn we trots op het feit dat we de beste fietsen op de markt verkopen met geweldige service. Onze enige klant (ik) heeft ons een 5/5 recensie gegeven.
        We hopen dat u iets leuk vindt.
        <p>Waarschuwing: Dit is geen echte webwinkel, alstublieft niks kopen en alsnog verwachten dat het product binnenkomt.</p>
      </span>
    </div>
    <?php
  }
  else{
    ?>
    <div class='homepageInfo'>
      <h3 class='row'>Welcome to our website!</h3>
      <span>
        Here at examen.aaronvanleijenhorst.xyz we pride outself for selling the best bikes on the market with excellent service. Rated 5/5 stars by our one and only customer (me).
        We hope you find something you like.
        <p>Warning: this isn't a real shop, please do not order something and expect it to actually be delivered.</p>
      </span>
    </div>
    <?php
  }
?>
<script>
$(".changeLanguage").change(function(){
  var language = $(this).val();
  if(language != ""){
    window.location.href ="http://examen.aaronvanleijenhorst.xyz/homepage&lang="+language;
  }
});
$(".switchProduct").click(function(){
  var product = $(this).attr('for');
  $(".newProduct[count='"+product+"']").show();
  $(".newProduct[count='"+product+"']").siblings('a').hide();
  $(".progressBar").css({"width":'0%'});
});
var amountOfProducts = $(".switchProduct:last-of-type").attr('for');
var count = 0;
var count2 = 0;

var Clock = {
  totalSeconds: 0,

  start: function () {
    var self = this;

    this.interval = setInterval(function () {
      count2++;
      // console.log(count2);
      var width = $(".progressBar").width() / $('.progressBar').parent().width() * 100;
      var newWidth = width += ("41.66666667" / 20);
      $(".progressBar").css({"width": newWidth + '%'});
      if(count2 % 20 == 0 || count2 == 1){
        ++count;
        $(".progressBar").css({"width":'0%'});
        var current = count % amountOfProducts;
        if(current == 0){
          current = 4;
        }
        $(".newProduct[count='"+current+"']").show();
        $(".newProduct[count='"+current+"']").siblings('a').hide();
        $(".switchProduct[for='"+current+"']").prop('checked', true);
        $(".switchProduct[for='"+current+"']").siblings().prop('checked', false);
      }
    }, 250);
  },

  pause: function () {
    $(".progressBar").css({"background-color":'red'});
    clearInterval(this.interval);
    delete this.interval;
  },

  resume: function () {
    $(".progressBar").css({"background-color":'blue'});
    if (!this.interval) this.start();
  }
};

Clock.start(count);
$(".newProduct").mouseenter(function(){
  Clock.pause();
}).mouseleave(function(){
  Clock.resume(count);
});
</script>
