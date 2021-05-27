<?php
include('class/Certificado.php');
$certificado = new Certificado();
$certificado->getCertficadoList($_POST['s_nrodoc'],$_POST['s_protocolo']);

?>