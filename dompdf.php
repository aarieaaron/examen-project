<link rel="stylesheet" type="text/css" href="style/pdfStyle.css">
<?php
require_once('dompdf-master/autoload.inc.php');
require 'PHPMailer/PHPMailerAutoload.php';
require_once('db_connect.php');
require_once('invoice.php');
use Dompdf\Dompdf;
$f;
$l;
if(headers_sent($f,$l))
{
    echo $f,'<br/>',$l,'<br/>';
    echo('now detect line');
}
$email = "aarieaaron2@live.nl";
// $invoice = getInvoice($email);
// echo $invoice;
$dompdf = new DOMPDF();
$dompdf->loadHtml($invoice);
// Render the HTML as PDF
$dompdf->render();
// var_dump($result);
$output = $dompdf->output();
file_put_contents('orders/INV'.$orderID.'.pdf', $output);

// echo 'test';
$mail = new PHPMailer;
$mail->setFrom('noreply@examen.aaronvanleijenhorst.xyz', 'Fietsen Winkel');
$mail->addAddress('aarieaaron2@live.nl', 'Aaron van Leijenhorst');
$mail->AddAttachment('orders/INV'.$orderID.'.pdf');
$mail->Subject  = 'Uw bestelling bij examen.aaronvanleijenhorst.xyz';
$mail->isHTML(true);
$mail->Body     = '<h1> Bedankt voor uw bestelling bij onze winkel </h1><br>
                   <h5> We hebben u een factuur in de bijlage gestuurd.</h5>';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}
?>
