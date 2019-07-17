<?php

define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "mail.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once('PHPMailer/class.phpmailer.php');

$mail             = new PHPMailer(); // defaults to using php "mail()"

$db = new clsDBConnection1();

  $SQL = "select * from certificados where nro =  ". $db->ToSQL(CCGetParam("s_nro",''),ccsText);
  $db->query($SQL);
  $result = $db->next_record();
  if ($result) 
      //$txt_archivo = $db->f("txt_archivo");
      $archivo = $db->f("archivo");
  //else
  	//  $txt_archivo = '';
  $db->close();
  


	$path = '../archivos/';
	$archivo = $db->f("archivo");
    $str = file_get_contents($path.$archivo);
       if($str===false)
        {
                $path = '../archivos.old/';
                $str = file_get_contents($path.$archivo);
        }
	

//$body = $txt_archivo;
//Attachments
if (strtolower(substr($archivo, -3)) == 'pdf'){
    $mail->addAttachment($path.$archivo);  
    $body = "Estimado paciente, <br>
<br>
              Puede ver sus resultados en el archivo adjunto a este correo. <br>
<br>
            Atentamente.<br>
            Laboratorios Raffo  ";
} 
else{   
        //$str = StrTr($str,"\x21", " ");
        $str = Str_replace("\x21", "",$str);
        $str = Str_replace("\x10", "",$str);
        $str = Str_replace("\x1B", "",$str);
        $str = Str_replace("\x08", "",$str);
        $str = Str_replace("\x00", "",$str);
      /*  $str = StrTr($str,"\x10", "");
        $str = StrTr($str,"\x1B", " ");
        $str = StrTr($str,"\x08", " ");
        $str = StrTr($str,"\x00", " ");
        $str = StrTr($str,"\x0A", " ");*/
        $str = StrTr($str,"\x82", "é");
        $str = StrTr($str,"\xA2", "ó");
        $str = StrTr($str,"\xA4", "ñ");
        $str = Str_replace("\x12", "",$str);
        $str = Str_replace("(s3B", "",$str);
        $str = Str_replace("(s11H", "",$str);
        $str = Str_replace("(s0S", "",$str);
        $str = Str_replace("(s0B", "",$str);
        $str = Str_replace("(s7B", "",$str);
        $str = StrTr($str,"\x0D", chr(10));

      //$txt_archivo = str_replace(chr(10),'<BR>',$str);
      $txt_archivo = $str;

      $body ="

      <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
        <tr>
          <td valign=\"top\">
            <table style=\"border-left: 1px solid #3d84cc; border-bottom: 1px solid #3d84cc;border-right: 1px solid #3d84cc;width: 100%;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
              <tr>
                <td style=\"background-image: url('http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/HeaderLeft.gif');\">
                <img alt=\"\" src=\"http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/Spacer.gif\" border=\"0\"></td> 
                <td style=\"font-size: 110%; font-weight: bold; text-align: left;	padding: 3px; background-color: #3d84cc; color: #ffffff; width: 100%;	white-space: nowrap;padding-left: 8px;\"><strong>Certificado</strong></td> 
                <td style=\"background-image: url('http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/HeaderRight.gif'); background-position: right top;\"><img alt=\"\" src=\"http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/Spacer.gif\" border=\"0\"></td>
              </tr>
            </table>
            <table style=\"border-left: 1px solid #3d84cc; border-bottom: 1px solid #3d84cc;border-right: 1px solid #3d84cc;width: 100%;\" cellspacing=\"0\" cellpadding=\"0\">
              <tr style=\"font-size: 80%; 	text-align: left; vertical-align: top;padding: 3px;	border-top: 1px solid #3d84cc; border-right: 1px solid #3d84cc;	background-color: #dfdfdf; color: #000000;	white-space: nowrap;\">
                <th scope=\"col\"></th>
              </tr>
              <tr style=\"font-size: 80%; font-weight: normal; text-align: left; vertical-align: top;	padding: 3px;	border-top: 1px solid #3d84cc; border-right: 1px solid #3d84cc;	background-color: #f7f7f7; color: #000000;	white-space: nowrap;	color: #000000;\">
                <td style=\"FONT-SIZE: 130%; FONT-FAMILY: 'Courier New', Courier, monospace\" width=\"900\"><pre>".$txt_archivo."</pre></td>
              </tr>
              <tr style=\"font-size: 80%;	padding: 3px;	border-top: 1px solid #3d84cc; border-right: 1px solid #3d84cc;	background-color: #f7f7f7; color: #000000;	text-align: center;	vertical-align: middle;	white-space: nowrap;	color: #000000;\">
                <td>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      ";
}
$body =  strval($body);

$mail->From       = "recepcion@laboratorioraffo.com";
$mail->FromName   = "Laboratorio Raffo";

$mail->Subject    = "Envio de certificado";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress(CCGetParam('mail',''), "");
//$mail->AddAddress("agarcia@alternativa.com.ar", "Adrian Garci");

//$mail->AddAttachment("images/phpmailer.gif");             // attachment

if(!$mail->Send()) {
  header('Location: postmail.php?r=ERR&&s_nro='.CCGetParam("s_nro",'').'t='.$mail->ErrorInfo);	
  //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  header('Location: postmail.php?r=OK&s_nro='.CCGetParam("s_nro",''));
}

?>
