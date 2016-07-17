<?php
  $str = file_get_contents('/home/labolar/public_html/archivos/A717605.TXT');
                                                                        //Insertar en la BD
                                                                        $pos = strpos($str, 'Paciente');
                                                                        $nombre                                 =  mysql_real_escape_string(substr($str,$pos+17,33));
                                                                        $pos = strpos($str, 'Orden');
                                                                        $orden          =  substr($str,$pos+8,8);
                                                                        $pos = strpos($str, 'Solicitado por');
                                                                        $solicitado     =  mysql_real_escape_string(substr($str,$pos+17,33));
                                                                        $pos = strpos($str, 'Fecha :');
                                                                        $fecha          =  substr($str,$pos+8,10);
                                                                        $pos = strpos($str, 'Observaciones  :');
                                                                        $observaciones  =  substr($str,$pos+17,33);
                                                                        $pos = strpos($str, 'Hoja  :');
                                                                        $sexo                             =  trim(substr($str,$pos+81,2));
                                                                        $tipodoc                                =  trim(substr($str,$pos+83,2));
                                                                        $documento                      =  trim(substr($str,$pos+85,9));
																		$pos = strpos($str, 'Afiliado Nro.  :');
																		$afiliado = substr($str,$pos+18,11);
																		echo $afiliado;
?>
