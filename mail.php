<?php
echo 'test';
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->setFrom('noreply@examen.aaronvanleijenhorst.xyz', 'Fietsen Winkel');
$mail->addAddress('aarieaaron2@live.nl', 'Aaron van Leijenhorst');
$mail->AddAttachment('orders/INV'.$orderID.'.pdf');
$mail->Subject  = 'Uw bestelling bij examen.aaronvanleijenhorst.xyz';
$mail->isHTML(true);
$mail->Body     = '<h1> Bedankt voor uw bestelling bij onze winkel </h1>';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}

?>
