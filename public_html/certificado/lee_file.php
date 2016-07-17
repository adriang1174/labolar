<?php

$dir = scandir('.',1);
var_dump($dir);
$str = file_get_contents('A570027.TXT');
//var_dump($str);
$pos = strpos($str, 'M D 00000000');
var_dump($pos);
$nombre 	=  substr($str,457,33);
$orden          =  substr($str,500,8);
$solicitado     =  substr($str,531,33);
$fecha          =  substr($str,574,10);
$observaciones  =  substr($str,607,33);
$sexo 		=  substr($str,724,1);
$documento	=  substr($str,728,8);

var_dump($documento);
//Acá grabar en la base de datos
?>
