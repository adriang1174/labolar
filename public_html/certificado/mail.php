<?php
include('class/Certificado.php');
$certificado = new Certificado();
$certificado->sendCertficadoEmail($_POST['s_nro'],$_POST['email']);

?>