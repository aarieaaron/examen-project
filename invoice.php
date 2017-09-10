<?php
  require('db_connect.php');
  session_start();
  if(!isset($email)){
    $email = "aarieaaron2@live.nl";
  }

  $query = "SELECT SA.street as SAstreet, SA.city as SAcity, SA.name as SAname, SA.email as SAemail, SA.zipcode as SAzipcode, IA.street as IAstreet, IA.city as IAcity, IA.name as IAname, IA.email as IAemail, IA.zipcode as IAzipcode, O.orderID, O.orderPlaced FROM Orders as O, ShippingAddress as SA, InvoiceAddress as IA
  WHERE O.orderID = IA.orderID AND SA.orderID = O.orderID AND O.orderID = (SELECT orderID FROM Orders WHERE email = '{$email}' ORDER BY orderID DESC LIMIT 1)";
  $result = mysqli_query($connection, $query);
  foreach($result as $row){
    $shippingStreet = $row['SAstreet'];
    $shippingZipcode = $row['SAzipcode'];
    $shippingCity = $row['SAcity'];
    $shippingEmail = $row['SAemail'];
    $shippingName = $row['SAname'];

    $invoiceStreet = $row['IAstreet'];
    $invoiceZipcode = $row['IAzipcode'];
    $invoiceCity = $row['IAcity'];
    $invoiceEmail = $row['IAemail'];
    $invoiceName = $row['IAname'];

    $orderID = $row['orderID'];
    $orderDate = $row['orderPlaced'];
    if(isset($_SESSION['userinfo']['userID'])){
      $userID = $_SESSION['userinfo']['userID'];
    }
    else{
      $userID = "NaN";
    }
    if(isset($_SESSION['userinfo']['userID'])){
      $query = "SELECT paymentMethod, bank FROM User WHERE userID = {$_SESSION['userinfo']['userID']}";
      $result = mysqli_query($connection, $query);
      foreach($result as $row){
        if($row['paymentMethod'] == 'ideal'){
          $paymentMethod = 'iDeal - Bank:' . $row['bank'];
        }
        else if ($row['paymentMethod'] == 'cash'){
          $paymentMethod = 'Aan de deur';
        }
        else if ($row['paymentMethod'] == 'bank'){
          $paymentMethod = 'Overmaken';
        }
        else if ($row['paymentMethod'] == 'paypal'){
          $paymentMethod = 'PayPal';
        }
      }
    }
    else{
      $paymentMethod = "Overmaken";
    }

    $invoice = '<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8">
    <title>bcl_995252174.htm</title>
    <meta name="generator" content="BCL easyConverter SDK 5.0.08">
    <style type="text/css">

    body {margin-top: 0px;margin-left: -65px;}

    #page_1 {position:relative; overflow: hidden;margin: 19px 0px 321px 66px;padding: 0px;border: none;width: 765px;}

    #page_1 #p1dimg1 {position:absolute;top:0px;left:0px;z-index:-1;width:661px;height:83px;}
    #page_1 #p1dimg1 #p1img1 {width:661px;height:83px;}




    .dclr {clear:both;float:none;height:1px;margin:0px;padding:0px;overflow:hidden;}

    .ft0{font: 1px "Arial";line-height: 1px;}
    .ft1{font: 27px "Arial";line-height: 32px;}
    .ft2{font: bold 11px "Arial";line-height: 14px;}
    .ft3{font: bold 10px "Arial";line-height: 12px;}
    .ft4{font: 11px "Arial";line-height: 14px;}
    .ft5{font: 1px "Arial";line-height: 9px;}
    .ft6{font: 1px "Arial";line-height: 7px;}
    .ft7{font: 1px "Arial";line-height: 6px;}
    .ft8{font: 1px "Arial";line-height: 10px;}
    .ft9{font: 10px "Arial";color: #ffffff;line-height: 13px;}
    .ft10{font: 9px "Arial";color: #ffffff;line-height: 12px;}
    .ft11{font: 10px "Arial";line-height: 13px;}
    .ft12{font: 1px "Arial";line-height: 5px;}
    .ft13{font: bold 13px "Arial";line-height: 16px;}

    .p0{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p1{text-align: right;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p2{text-align: left;padding-left: 20px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p3{text-align: left;padding-left: 10px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p4{text-align: left;padding-left: 2px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p5{text-align: right;padding-right: 11px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p6{text-align: right;padding-right: 14px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p7{text-align: right;padding-right: 16px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p8{text-align: left;padding-left: 3px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p9{text-align: right;padding-right: 2px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p10{text-align: right;padding-right: 3px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p11{text-align: left;padding-left: 14px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p12{text-align: right;padding-right: 20px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p13{text-align: right;padding-right: 15px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p14{text-align: left;padding-left: 24px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
    .p15{text-align: left;padding-left: 450px;margin-top: 19px;margin-bottom: 0px;}
    .p16{text-align: left;padding-left: 450px;margin-top: 3px;margin-bottom: 0px;}

    .td0{padding: 0px;margin: 0px;width: 113px;vertical-align: bottom;}
    .td1{padding: 0px;margin: 0px;width: 92px;vertical-align: bottom;}
    .td2{padding: 0px;margin: 0px;width: 152px;vertical-align: bottom;}
    .td3{padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;}
    .td4{padding: 0px;margin: 0px;width: 235px;vertical-align: bottom;}
    .td5{padding: 0px;margin: 0px;width: 205px;vertical-align: bottom;}
    .td6{padding: 0px;margin: 0px;width: 41px;vertical-align: bottom;}
    .td7{padding: 0px;margin: 0px;width: 30px;vertical-align: bottom;}
    .td8{padding: 0px;margin: 0px;width: 57px;vertical-align: bottom;}
    .td9{padding: 0px;margin: 0px;width: 107px;vertical-align: bottom;}
    .td10{padding: 0px;margin: 0px;width: 46px;vertical-align: bottom;}
    .td11{padding: 0px;margin: 0px;width: 61px;vertical-align: bottom;}
    .td12{padding: 0px;margin: 0px;width: 221px;vertical-align: bottom;}
    .td13{padding: 0px;margin: 0px;width: 164px;vertical-align: bottom;}
    .td14{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 113px;vertical-align: bottom;background: #999999;}
    .td15{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 92px;vertical-align: bottom;background: #999999;}
    .td16{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 152px;vertical-align: bottom;background: #999999;}
    .td17{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;background: #999999;}
    .td18{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 41px;vertical-align: bottom;background: #999999;}
    .td19{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 30px;vertical-align: bottom;background: #999999;}
    .td20{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 57px;vertical-align: bottom;background: #999999;}
    .td21{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 46px;vertical-align: bottom;background: #999999;}
    .td22{border-bottom: #999999 1px solid;padding: 0px;margin: 0px;width: 61px;vertical-align: bottom;background: #999999;}
    .td23{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 205px;vertical-align: bottom;background: #eeeeee;}
    .td24{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 152px;vertical-align: bottom;background: #eeeeee;}
    .td25{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;background: #eeeeee;}
    .td26{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 41px;vertical-align: bottom;background: #eeeeee;}
    .td27{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 30px;vertical-align: bottom;background: #eeeeee;}
    .td28{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 57px;vertical-align: bottom;background: #eeeeee;}
    .td29{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 46px;vertical-align: bottom;background: #eeeeee;}
    .td30{border-top: #dddddd 1px solid;padding: 0px;margin: 0px;width: 61px;vertical-align: bottom;background: #eeeeee;}
    .td31{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 205px;vertical-align: bottom;background: #eeeeee;}
    .td32{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 152px;vertical-align: bottom;background: #eeeeee;}
    .td33{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;background: #eeeeee;}
    .td34{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 41px;vertical-align: bottom;background: #eeeeee;}
    .td35{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 30px;vertical-align: bottom;background: #eeeeee;}
    .td36{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 57px;vertical-align: bottom;background: #eeeeee;}
    .td37{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 46px;vertical-align: bottom;background: #eeeeee;}
    .td38{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 61px;vertical-align: bottom;background: #eeeeee;}
    .td39{padding: 0px;margin: 0px;width: 205px;vertical-align: bottom;background: #eeeeee;}
    .td40{padding: 0px;margin: 0px;width: 152px;vertical-align: bottom;background: #eeeeee;}
    .td41{padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;background: #eeeeee;}
    .td42{padding: 0px;margin: 0px;width: 41px;vertical-align: bottom;background: #eeeeee;}
    .td43{padding: 0px;margin: 0px;width: 30px;vertical-align: bottom;background: #eeeeee;}
    .td44{padding: 0px;margin: 0px;width: 57px;vertical-align: bottom;background: #eeeeee;}
    .td45{padding: 0px;margin: 0px;width: 46px;vertical-align: bottom;background: #eeeeee;}
    .td46{padding: 0px;margin: 0px;width: 61px;vertical-align: bottom;background: #eeeeee;}
    .td47{padding: 0px;margin: 0px;width: 113px;vertical-align: bottom;background: #eeeeee;}
    .td48{padding: 0px;margin: 0px;width: 92px;vertical-align: bottom;background: #eeeeee;}
    .td49{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 113px;vertical-align: bottom;background: #eeeeee;}
    .td50{border-bottom: #dddddd 1px solid;padding: 0px;margin: 0px;width: 92px;vertical-align: bottom;background: #eeeeee;}
    .td51{padding: 0px;margin: 0px;width: 128px;vertical-align: bottom;}
    .td52{padding: 0px;margin: 0px;width: 87px;vertical-align: bottom;}
    .td53{padding: 0px;margin: 0px;width: 174px;vertical-align: bottom;}
    .td54{padding: 0px;margin: 0px;width: 71px;vertical-align: bottom;}

    .tr0{height: 40px;}
    .tr1{height: 36px;}
    .tr2{height: 47px;}
    .tr3{height: 16px;}
    .tr4{height: 17px;}
    .tr5{height: 26px;}
    .tr6{height: 9px;}
    .tr7{height: 7px;}
    .tr8{height: 23px;}
    .tr9{height: 6px;}
    .tr10{height: 10px;}
    .tr11{height: 50px;}
    .tr12{height: 25px;}
    .tr13{height: 5px;}
    .tr14{height: 15px;}
    .tr15{height: 14px;}
    .tr16{height: 33px;}

    .t0{width: 661px;margin-top: 44px;font: 11px "Arial";}

    </style>
    </head>

    <body>
    <div id="page_1">
    <div id="p1dimg1">
    <img src="" alt=""></div>


    <div class="dclr"></div>
    <table cellpadding="0" cellspacing="0" class="t0">
    <tbody><tr>
    	<td class="tr0 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr0 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr0 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr0 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="5" class="tr0 td4"><p class="p1 ft1">Factuur INV'.$orderID.'</p></td>
    </tr>
    <tr>
    	<td class="tr1 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr1 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr1 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr1 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="5" class="tr1 td4"><p class="p1 ft1">Order '.$orderID.'</p></td>
    </tr>
    <tr>
    	<td colspan="2" class="tr2 td5"><p class="p0 ft2">'.$invoiceName.'</p></td>
    	<td class="tr2 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr2 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr2 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr2 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr2 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr2 td9"><p class="p1 ft3">www.examen.aaronvanleijenhorst.xyz</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft4">'.$invoiceStreet.'</p></td>
    	<td class="tr3 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr3 td9"><p class="p1 ft4">info@examen.aaronvanleijenhorst.xyz</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft4">'.$invoiceZipcode.' '.$invoiceCity.'</p></td>
    	<td class="tr3 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr3 td9"><p class="p1 ft4">Tel +31 06-10239389</p></td>
    </tr>
    <tr>
    	<td class="tr4 td0"><p class="p0 ft4">'.$invoiceEmail.'</p></td>
    	<td class="tr4 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" rowspan="2" class="tr5 td9"><p class="p1 ft2">aaronvanleijenhorst.xyz</p></td>
    </tr>
    <tr>
    	<td rowspan="2" class="tr3 td0"><p class="p0 ft4"></p></td>
    	<td class="tr6 td1"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td2"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td3"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td6"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td7"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td8"><p class="p0 ft5">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr7 td1"><p class="p0 ft6">&nbsp;</p></td>
    	<td class="tr7 td2"><p class="p0 ft6">&nbsp;</p></td>
    	<td class="tr7 td3"><p class="p0 ft6">&nbsp;</p></td>
    	<td class="tr7 td6"><p class="p0 ft6">&nbsp;</p></td>
    	<td class="tr7 td7"><p class="p0 ft6">&nbsp;</p></td>
    	<td class="tr7 td8"><p class="p0 ft6">&nbsp;</p></td>
    	<td colspan="2" rowspan="2" class="tr3 td9"><p class="p1 ft4">Hazepad 6</p></td>
    </tr>
    <tr>
    	<td class="tr6 td0"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td1"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td2"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td3"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td6"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td7"><p class="p0 ft5">&nbsp;</p></td>
    	<td class="tr6 td8"><p class="p0 ft5">&nbsp;</p></td>
    </tr>
    <tr>
    	<td rowspan="2" class="tr8 td0"><p class="p0 ft4"></p></td>
    	<td class="tr4 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr4 td9"><p class="p1 ft4">3766JT Soest</p></td>
    </tr>
    <tr>
    	<td class="tr9 td1"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td2"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td3"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td6"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td7"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td8"><p class="p0 ft7">&nbsp;</p></td>
    	<td colspan="2" rowspan="2" class="tr3 td9"><p class="p1 ft4"><nobr>Utrecht</nobr></p></td>
    </tr>
    <tr>
    	<td colspan="2" rowspan="2" class="tr3 td5"><p class="p0 ft4"></p></td>
    	<td class="tr10 td2"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td3"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td6"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td7"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td8"><p class="p0 ft8">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr9 td2"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td3"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td6"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td7"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td8"><p class="p0 ft7">&nbsp;</p></td>
    	<td class="tr9 td10"><p class="p0 ft7">&nbsp;</p></td>
    	<td rowspan="2" class="tr3 td11"><p class="p1 ft4">Nederland</p></td>
    </tr>
    <tr>
    	<td class="tr10 td0"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td1"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td2"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td3"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td6"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td7"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td8"><p class="p0 ft8">&nbsp;</p></td>
    	<td class="tr10 td10"><p class="p0 ft8">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr11 td0"><p class="p0 ft2">Factuurnummer</p></td>
    	<td class="tr11 td1"><p class="p0 ft2">Ordernummer</p></td>
    	<td colspan="2" class="tr11 td12"><p class="p2 ft2">Klantnummer</p></td>
    	<td class="tr11 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr11 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr11 td8"><p class="p3 ft2">Datum</p></td>
    	<td class="tr11 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr11 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft4">INV'.$orderID.'</p></td>
    	<td class="tr3 td1"><p class="p0 ft4">ORD'.$orderID.'</p></td>
    	<td class="tr3 td2"><p class="p2 ft4">'.$userID.'</p></td>
    	<td class="tr3 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="3" class="tr3 td13"><p class="p3 ft4">'.$orderDate.'</p></td>
    </tr>
    <tr>
    	<td class="tr12 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td7"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr12 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr4 td14"><p class="p4 ft9">Beschrijving</p></td>
    	<td class="tr4 td15"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td16"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td17"><p class="p4 ft9">Artikelcode</p></td>
    	<td class="tr4 td18"><p class="p4 ft9">Aantal</p></td>
    	<td class="tr4 td19"><p class="p5 ft9">btw</p></td>
    	<td class="tr4 td20"><p class="p6 ft9">Item prijs</p></td>
    	<td class="tr4 td21"><p class="p4 ft9">Korting</p></td>
    	<td class="tr4 td22"><p class="p7 ft10">Subtotaal</p></td>
    </tr>
    ';
    $query = "SELECT P.*, count(P.productID) FROM Product as P, Item as I, Orders as O, OrderDetails as OD WHERE O.orderID = {$orderID} AND O.orderID = OD.orderID AND OD.itemID = I.itemID AND I.productID = P.productID GROUP BY productID";
    $result = mysqli_query($connection, $query);
    $productCombinedPrice = 0;
    foreach($result as $row){
      $productName = $row['productName'];
      $productID = $row['productID'];
      $productCount = $row['count(P.productID)'];
      $productPrice = $row['productPrice'];
      $totalProductPrice = $productPrice * $productCount;
      $productCombinedPrice += $totalProductPrice;
      $invoice .='
      <tr>
      	<td colspan="2" class="tr14 td39"><p class="p8 ft3">'.$productName.'</p></td>
      	<td class="tr14 td40"><p class="p0 ft0">&nbsp;</p></td>
      	<td class="tr14 td41"><p class="p8 ft11">I'.$productID.'</p></td>
      	<td class="tr14 td42"><p class="p9 ft11">'.$productCount.'x</p></td>
      	<td class="tr14 td43"><p class="p10 ft11">21%</p></td>
      	<td class="tr14 td44"><p class="p10 ft11">€'.number_format($productPrice, 2).'</p></td>
      	<td class="tr14 td45"><p class="p11 ft11"></p></td>
      	<td class="tr14 td46"><p class="p10 ft11">€'.number_format($totalProductPrice, 2).'</p></td>
      </tr>
      <tr>
      	<td colspan="2" class="tr13 td31"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td32"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td33"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td34"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td35"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td36"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td37"><p class="p0 ft12">&nbsp;</p></td>
      	<td class="tr13 td38"><p class="p0 ft12">&nbsp;</p></td>
      </tr>';
    }
    $productCombinedPriceExclBTW = $productCombinedPrice / (121 / 100);
    $productCombinedPriceBTW = $productCombinedPrice - $productCombinedPriceExclBTW;
    $invoice .=
    '
    <tr>
    	<td colspan="2" class="tr14 td39"><p class="p8 ft3">Verzending en afhandeling</p></td>
    	<td class="tr14 td40"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr14 td41"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr14 td42"><p class="p9 ft11">1x</p></td>
    	<td class="tr14 td43"><p class="p10 ft11">21%</p></td>
    	<td class="tr14 td44"><p class="p10 ft11">€0,00</p></td>
    	<td class="tr14 td45"><p class="p11 ft11"></p></td>
    	<td class="tr14 td46"><p class="p10 ft11">€0,00</p></td>
    </tr>
    <tr>
    	<td class="tr15 td47"><p class="p8 ft11">DHL 24u</p></td>
    	<td class="tr15 td48"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td40"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td41"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td42"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td43"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td44"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td45"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td46"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr13 td49"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td50"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td32"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td33"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td34"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td35"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td36"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td37"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td38"><p class="p0 ft12">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr14 td47"><p class="p8 ft3">Betaalkosten</p></td>
    	<td class="tr14 td48"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr14 td40"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr14 td41"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr14 td42"><p class="p9 ft11">1x</p></td>
    	<td class="tr14 td43"><p class="p10 ft11">0%</p></td>
    	<td class="tr14 td44"><p class="p10 ft11">€0,00</p></td>
    	<td class="tr14 td45"><p class="p11 ft11">€0,00</p></td>
    	<td class="tr14 td46"><p class="p10 ft11">€0,00</p></td>
    </tr>
    <tr>
    	<td class="tr15 td47"><p class="p8 ft11">'.$paymentMethod.'</p></td>
    	<td class="tr15 td48"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td40"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td41"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td42"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td43"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td44"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td45"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr15 td46"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr13 td47"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td48"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td40"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td41"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td42"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td43"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td44"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td45"><p class="p0 ft12">&nbsp;</p></td>
    	<td class="tr13 td46"><p class="p0 ft12">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr16 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr16 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr16 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr16 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="3" class="tr16 td51"><p class="p12 ft4">Totaal excl. btw</p></td>
    	<td class="tr16 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr16 td11"><p class="p13 ft4">€'.number_format($productCombinedPriceExclBTW,2).'</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td6"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr3 td52"><p class="p12 ft4">btw 21%</p></td>
    	<td class="tr3 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td11"><p class="p6 ft4">€'.number_format($productCombinedPriceBTW,2).'</p></td>
    </tr>
    <tr>
    	<td class="tr5 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr5 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr5 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr5 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="3" class="tr5 td51"><p class="p12 ft13">Totaal incl. btw</p></td>
    	<td class="tr5 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr5 td11"><p class="p0 ft13">€'.number_format($productCombinedPrice,2).'</p></td>
    </tr>
    <tr>
    	<td class="tr2 td0"><p class="p0 ft2">Bedrijfsgegevens</p></td>
    	<td class="tr2 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr2 td12"><p class="p2 ft2">Bankgegevens</p></td>
    	<td colspan="3" class="tr2 td51"><p class="p14 ft2">Afleveradres</p></td>
    	<td class="tr2 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr2 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td colspan="2" class="tr3 td5"><p class="p0 ft4"><nobr>btw-nummer</nobr> NL1243456789</p></td>
    	<td colspan="2" class="tr3 td12"><p class="p2 ft4">Rekeninghouder Netwings</p></td>
    	<td colspan="4" class="tr3 td53"><p class="p14 ft4">'.$shippingName.'</p></td>
    	<td class="tr3 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td colspan="2" class="tr4 td5"><p class="p0 ft4">Directeur Aaron van Leijenhorst</p></td>
    	<td colspan="2" class="tr4 td12"><p class="p2 ft4">Bank ING</p></td>
    	<td colspan="3" class="tr4 td51"><p class="p14 ft4">'.$shippingStreet.'</p></td>
    	<td class="tr4 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr4 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr3 td12"><p class="p2 ft4">NL74 INGB 0001 0294 10</p></td>
    	<td colspan="3" class="tr3 td51"><p class="p14 ft4">'.$shippingZipcode.' '.$shippingCity.'</p></td>
    	<td class="tr3 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="2" class="tr3 td12"><p class="p2 ft4">BIC BBRUBEBB</p></td>
    	<td colspan="2" class="tr3 td54"><p class="p14 ft4"></p></td>
    	<td class="tr3 td8"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    <tr>
    	<td class="tr3 td0"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td1"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td2"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td3"><p class="p0 ft0">&nbsp;</p></td>
    	<td colspan="3" class="tr3 td51"><p class="p14 ft4"></p></td>
    	<td class="tr3 td10"><p class="p0 ft0">&nbsp;</p></td>
    	<td class="tr3 td11"><p class="p0 ft0">&nbsp;</p></td>
    </tr>
    </tbody></table>
    <p class="p15 ft2">Betaalmethode</p>
    <p class="p16 ft4">'.$paymentMethod.'</p>
    </div>


    </body></html>';
    // echo $invoice;
}
?>
