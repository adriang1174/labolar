<?php

include_once('../class.phpmailer.php');

$mail             = new PHPMailer(); // defaults to using php "mail()"

$body             = $mail->getFile('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->From       = "laboratorio@laboratorioraffo.com";
$mail->FromName   = "Labo";

$mail->Subject    = "PHPMailer Test Subject via smtp";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress("agarcia@alternativa.com.ar", "Adrian Garci");

$mail->AddAttachment("images/phpmailer.gif");             // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>
