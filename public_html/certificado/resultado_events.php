<?php
//BindEvents Method @1-EC5D568B
function BindEvents()
{
    global $certificado;
    $certificado->txt_archivo->CCSEvents["BeforeShow"] = "certificado_txt_archivo_BeforeShow";
    $certificado->CCSEvents["BeforeShow"] = "certificado_BeforeShow";
}
//End BindEvents Method

//certificado_txt_archivo_BeforeShow @3-60F7FF00
function certificado_txt_archivo_BeforeShow(& $sender)
{
    $certificado_txt_archivo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $certificado; //Compatibility
//End certificado_txt_archivo_BeforeShow

//Custom Code @13-2A29BDB7
// -------------------------
	$path = '../archivos/';
	$archivo = $certificado->archivo->GetValue();
    $str = file_get_contents($path.$archivo);
	if($str===false)
	{
		$path = '../archivos.old/';		
	        $str = file_get_contents($path.$archivo);
	}

	if (substr($archivo, -3) <> 'pdf'){

		$str = StrTr($str,"\x21", " ");
		$str = Str_replace("\x21", "",$str);
		$str = Str_replace("\x10", "",$str);
		$str = Str_replace("\x1B", "",$str);
		$str = Str_replace("\x08", "",$str);
		$str = Str_replace("\x00", "",$str);
	//
		$str = StrTr($str,"\x10", "");
		$str = StrTr($str,"\x1B", " ");
		$str = StrTr($str,"\x08", " ");
		$str = StrTr($str,"\x00", " ");
		$str = StrTr($str,"\x0A", " ");
	//
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
	}
	else{
		$str = "<a href=../archivos/".$archivo." style='FONT-SIZE: 80%; FONT-FAMILY: Arial;'> 
					<img src='PDF.png' alt='PDF icon'>Ver resultados</a> ";
	}

$certificado->txt_archivo->SetValue($str);
// -------------------------
//End Custom Code

//Close certificado_txt_archivo_BeforeShow @3-4A386BF8
    return $certificado_txt_archivo_BeforeShow;
}
//End Close certificado_txt_archivo_BeforeShow

//certificado_BeforeShow @2-27C9E2D2
function certificado_BeforeShow(& $sender)
{
    $certificado_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $certificado; //Compatibility
//End certificado_BeforeShow

//Custom Code @5-2A29BDB7
// -------------------------
if(CCGetParam('s_nro','') == '' ) 
	$certificado->Visible = false;
else
	$certificado->Visible = true;
// -------------------------
//End Custom Code

//Close certificado_BeforeShow @2-A7E66C5E
    return $certificado_BeforeShow;
}
//End Close certificado_BeforeShow
?>
