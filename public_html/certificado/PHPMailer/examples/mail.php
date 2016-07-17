<?php

include_once('../class.phpmailer.php');

$mail             = new PHPMailer(); // defaults to using php "mail()"

$body ="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<meta http-equiv='content-type' content='text/html; charset=windows-1252'>
<title>Certificado</title>
<link href='http://www.laboratorioraffo.com/certificado/Styles/Simple/Style_doctype.css' type='text/css' rel='stylesheet'>
<script language='JavaScript' type='text/javascript'>
//Begin CCS script
//Include Common JSFunctions @1-D3B5F5BF
</script>
<script language='JavaScript' src='http://www.laboratorioraffo.com/certificado/ClientI18N.php?file=Functions.js&amp;locale=es' type='text/javascript' charset='utf-8'></script>
</head>
<body>
&nbsp; 
<table cellspacing='0' cellpadding='0' border='0'>
  <tr>
    <td valign='top'>
      <table class='Header' cellspacing='0' cellpadding='0' border='0'>
        <tr>
          <td class='HeaderLeft'><img alt='' src='http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/Spacer.gif' border='0'></td> 
          <td class='th'><strong>Certificado</strong></td> 
          <td class='HeaderRight'><img alt='' src='http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/Spacer.gif' border='0'></td>
        </tr>
      </table>
      <table class='Grid' cellspacing='0' cellpadding='0'>
        <tr class='Caption'>
          <th scope='col'></th>
        </tr>
        <tr class='Row'>
          <td width='900'>         LABORATORIO DR. LUIS ALBERTO RAFFO                                             <BR> ANALISIS CLINICOS                       Dr.Luis A. Raffo  Dr.Fernando L. Raffo <BR>         LAPRIDA 1225 PB&quot;A&quot;- CAP.FED.            MN 323-b          MN 6925              <BR> (1425)     www.laboratorioraffo.com    <BR> Te : *4821-1212*  ALT.:4826-4949       <BR> <BR> <BR>         ===============================================================================<BR>     Paciente       : MIRABETE RAUL                      Orden : A 592368<BR>     Solicitado por : DIAZ VELEZ NAZARIO DR.             Fecha : 01/03/2012<BR>     Observaciones  : X2                                 Hoja  : 001 de 001<BR>                                                               M D 04390680<BR> ===============================================================================<BR>         <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR>                                  Resultado       Unidades   Valores  de  refer.<BR> -------------------------------------------------------------------------------<BR> <BR>                 * TIEMPO DE PROTROMBINA *                    <BR>                   Método : Mecanico                              <BR>           Resultado                    :         32               %     70       100<BR>           RIN                          :          2.48<BR>         Instrumento: STA Compact (Roche)<BR>         Reactivo: Neoplastine Plus(Stago)<BR>         <BR>                 * CONTROL DE RESULTADOS                      <BR>                                        : .-<BR>                                         Los resultados de estos estudios fueron<BR>                                         controlados y evaluados por los Directo-<BR>                                         res Tecnicos del Laboratorio Raffo.-<BR>         <BR>                 * FINAL DEL INFORME DEL PACIENTE             <BR>                                          ===============<BR>                                         ========================================<BR>                                         ========================================<BR>         <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR> <BR>        LAB. SOMETIDO A CONTROL DE CALIDAD INTERNO Y EXTERNO.                  <BR>     LOS RESULTADOS NO EXPRESAN DIAGNOSTICOS. CONSULTE SIEMPRE A SU MEDICO. <BR> </td>
        </tr>
        <tr class='Footer'>
          <td>
            </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>";

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
