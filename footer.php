<div class="disclaimer row">
  <p> Disclaimer: Deze website is gemaakt door Aaron van Leijenhorst als examen project voor zijn opleiding.<br>
      Deze website is bedoeld om fiets-verkoop.nl na te bootsen in gevoel maar met mijn eigen 'swing' erachter. </p>
</div>
<div class="sitemap row">
  <h5><span class=''><i class="fa fa-caret-right sitemapArrow" aria-hidden="true"></i></span><b>Sitemap</b><span class=''><i class="fa fa-caret-right sitemapArrow sitemapRightArrow" aria-hidden="true"></i></span></h5>
  <div class='sitemapContent'  display='hidden'>
    <?php
    //Guest links here
    if(!hasRole('user')){
    ?>
    <div class='col-md-4'>
      <a href='/homepage' class='row'>Home Pagina</a>
      <a href='/search' class='row'>Zoek Pagina</a>
      <a href='/bestelinfo' class='row'>Bestel Informatie Pagina</a>
      <a href='/login' class='row'>Login Pagina</a>
      <a href='/register' class='row'>Registreer Pagina</a>
    </div>
    <?php
    }
    //Registrered customer links here
    if(hasRole('user')){
    ?>
    <div class='col-md-4'>
      <a href='/homepage' class='row'>Home Pagina</a>
      <a href='/search' class='row'>Zoek Pagina</a>
      <a href='/bestelinfo' class='row'>Bestel Informatie Pagina</a>
      <a href='/logout' class='row'>Logout Pagina</a>
    </div>
    <?php
    }
    //Admin links here
    if(hasRole('admin')){
    ?>
    <div class='col-md-4'>
      <a href='/admin' class='row'>Admin Pagina</a>
    </div>
    <?php
    }
    //Employee Links Here
    if(hasRole('medewerker')){
    ?>
    <div class='col-md-4'>
      <a href='/medewerker' class='row'>Medewerker Pagina</a>
    </div>
    <?php
    }
    ?>
  </div>
</div>
<script>
$(".sitemap h5").click(function(){
  console.log($(".sitemapContent").attr('display'));
  var sitemapContent = $(".sitemapContent");

  if($(sitemapContent).attr('display') == 'hidden'){
    $(sitemapContent).attr('display', 'shown');
    $(".sitemapArrow:eq(0)").css({transform: 'rotate(90deg)'});
    $(".sitemapArrow:eq(1)").css({transform: 'rotate(90deg)'});
    $(sitemapContent).animate({height: '180px' }, 250);
  }
  else if($(sitemapContent).attr('display') == 'shown'){
    $(sitemapContent).attr('display', 'hidden');
    $(".sitemapArrow:eq(0)").css({transform: 'rotate(0deg)'});
    $(".sitemapArrow:eq(1)").css({transform: 'rotate(180deg)'});
    $(sitemapContent).animate({height : '0px' }, 250);
  }
});
</script>
