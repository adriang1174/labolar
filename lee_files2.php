<?php
$path = './public_html/archivos/';

$directorio = opendir($path);  

$link =  mysql_connect('localhost', 'labolar_user', 'labolar*123');
if (!$link) {
    echo 'No pudo conectarse: ' . mysql_error();
    exit;
}
mysql_select_db('labolar_certi'); 

//Agregar tabla de log y loguear ejec

while ($archivo = readdir($directorio)) {  
		echo date('d M Y h:i:s ')." ".$archivo.": ";
		$str = '';
		if (!($archivo=="." || $archivo=="..")) {  
						//Chequear archivo contra base de datos a ver si est� cargado
						$query = "select count(*) as existe from certificados where archivo ='".$archivo."'"; 
						//echo $query;
						$result = mysql_query($query);
						//var_dump($result);
						$res = mysql_fetch_assoc($result);
						//var_dump($res);
						if($res['existe'] == '0')					
						{
									$str = file_get_contents($path.$archivo);
									//Insertar en la BD
									$pos = strpos($str, 'Paciente');
									$nombre 				=  mysql_real_escape_string(substr($str,$pos+17,33));
									$pos = strpos($str, 'Orden');
									$orden          =  substr($str,$pos+8,8);
									$pos = strpos($str, 'Solicitado por');
									$solicitado     =  mysql_real_escape_string(substr($str,$pos+17,33));
									$pos = strpos($str, 'Fecha :');
									$fecha          =  substr($str,$pos+8,10);
									$pos = strpos($str, 'Observaciones  :');
									$observaciones  =  substr($str,$pos+17,33);
									$pos = strpos($str, 'Hoja  :');
									$sexo 				  =  trim(substr($str,$pos+81,2));
									$tipodoc				=  trim(substr($str,$pos+83,2));			
									$documento			=  trim(substr($str,$pos+85,9));	
									$pos = strpos($str, 'Afiliado Nro.  :');
									$afiliado = trim(substr($str,$pos+18,22));
//$str						=  preg_replace("/[\x1B\x21\x08\x00\x0D\x0A]/", " ", $str);
									$str = StrTr($str,"\x0D", chr(10));
									$str = StrTr($str,"\x21", " ");
									//$str = StrTr($str,"\x10", "");
									//$str = StrTr($str,"\x1B", " ");
									//$str = StrTr($str,"\x08", " ");
									//$str = StrTr($str,"\x00", " ");
									//$str = StrTr($str,"\x0A", " ");
									$str = StrTr($str,"\x82", "�");
									$str = StrTr($str,"\xA2", "�");
									$str = StrTr($str,"\xA4", "�");
									$str = Str_replace("(s3B", "",$str);
									$str = Str_replace("(s11H", "",$str);
									$str = Str_replace("(s0S", "",$str);
									$str = Str_replace("(s0B", "",$str);
									$str = Str_replace("(s7B", "",$str);
									$str = Str_replace("\x12", " ",$str);
									$str = mysql_real_escape_string($str);
									//var_dump($sexo);
																		
									if (strlen(trim($fecha)) < 10)
									{
												$sql = "INSERT INTO certificados (nro,afiliado,nombre,fecha,sexo,tipodoc,nrodoc,observaciones,archivo,txt_archivo)
									        VALUES('".$orden."','".$afiliado."','".$nombre."',null,'".$sexo."','".$tipodoc."','".$documento."','".$observaciones."','".$archivo."','".$str."')";
			 									//echo '\n\n'.$sql.'\n\n';									      
									}
									else
									{
												$var = explode('/',str_replace('-','/',$fecha));
			 									$fecha = "$var[2]-$var[1]-$var[0]";
			 									//var_dump($fecha);
												$sql = "INSERT INTO certificados (nro,afiliado,nombre,fecha,sexo,tipodoc,nrodoc,observaciones,archivo,txt_archivo)
									        VALUES('".$orden."','".$afiliado."','".$nombre."','".date("Y-m-d", strtotime($fecha))."','".$sexo."','".$tipodoc."','".$documento."','".$observaciones."','".$archivo."','".$str."')";
									}
									//echo $sql;
									echo "Insertando protocolo: ".$orden.". ";									
									mysql_query($sql);
									echo "Result: ".mysql_error()." " ;
									echo "Registros insertados: ".mysql_affected_rows()."\n";
									//echo mysql_error();
						}
						else
						{	
									//Ac� hay que hacer update
									$str = file_get_contents($path.$archivo);
									//Update en la BD
									$pos = strpos($str, 'Paciente');
									$nombre 				=  mysql_real_escape_string(substr($str,$pos+17,33));
									$pos = strpos($str, 'Orden');
									$orden          =  substr($str,$pos+8,8);
									$pos = strpos($str, 'Solicitado por');
									$solicitado     =  mysql_real_escape_string(substr($str,$pos+17,33));
									$pos = strpos($str, 'Fecha :');
									$fecha          =  substr($str,$pos+8,10);
									$pos = strpos($str, 'Observaciones  :');
									$observaciones  =  substr($str,$pos+17,33);
									$pos = strpos($str, 'Hoja  :');
									$sexo 				  =  trim(substr($str,$pos+81,2));
									$tipodoc				=  trim(substr($str,$pos+83,2));			
									$documento			=  trim(substr($str,$pos+85,9));	
                                                                        $pos = strpos($str, 'Afiliado Nro.  :');
                                                                        $afiliado = trim(substr($str,$pos+18,22));
									$str = StrTr($str,"\x0D", chr(10));
									$str = StrTr($str,"\x21", " ");
									//$str = StrTr($str,"\x10", "");
									//$str = StrTr($str,"\x1B", " ");
									//$str = StrTr($str,"\x08", " ");
									//$str = StrTr($str,"\x00", " ");
									//$str = StrTr($str,"\x0A", " ");
									$str = StrTr($str,"\x82", "�");
									$str = StrTr($str,"\xA2", "�");
									$str = StrTr($str,"\xA4", "�");
									$str = Str_replace("(s3B", "",$str);
									$str = Str_replace("(s11H", "",$str);
									$str = Str_replace("(s0S", "",$str);
									$str = Str_replace("(s0B", "",$str);
									$str = Str_replace("(s7B", "",$str);
									$str = Str_replace("\x12", " ",$str);
									$str = mysql_real_escape_string($str);
									
									//var_dump($str);
									if (strlen(trim($fecha)) < 10)						
															$sql = "UPDATE certificados 
																			set 
afiliado                        = '".$afiliado."',
nombre  			= '".$nombre."',
																			    fecha   			= null,
																			    sexo    			= '".$sexo."',
																			    tipodoc 			=	'".$tipodoc."',
																			    nrodoc				= '".$documento."',
																			    observaciones	= '".$observaciones."',
																			    archivo				= '".$archivo."',
																			    txt_archivo		= '".$str."'
																			 WHERE nro = '".$orden."'";
									else
									{
															$var = explode('/',str_replace('-','/',$fecha));
			 												$fecha = "$var[2]-$var[1]-$var[0]";															
															$sql = "UPDATE certificados 
set
afiliado                        = '".$afiliado."',
nombre  			= '".$nombre."',
																			    fecha   			= '".date("Y-m-d", strtotime($fecha))."',
																			    sexo    			= '".$sexo."',
																			    tipodoc 			=	'".$tipodoc."',
																			    nrodoc				= '".$documento."',
																			    observaciones	= '".$observaciones."',
																			    archivo				= '".$archivo."',
																			    txt_archivo		= '".$str."'
																			 WHERE nro = '".$orden."'";									
									}
									echo "Actualizando protocolo: ".$orden.". ";
									mysql_query($sql);
									echo "Result: ".mysql_error()." " ;		
									echo "Registros actualizados: ".mysql_affected_rows()."\n";
						}
		}
		//unlink($archivo);
} 
mysql_close($link);
?>
