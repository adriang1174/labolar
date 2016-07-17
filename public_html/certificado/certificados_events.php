<?php
//BindEvents Method @1-CF147856
function BindEvents()
{
    global $certificado;
    $certificado->CCSEvents["BeforeShow"] = "certificado_BeforeShow";
}
//End BindEvents Method

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
	$certificados->Visible = false;
else
	$certificados->Visible = true;
// -------------------------
//End Custom Code

//Close certificado_BeforeShow @2-A7E66C5E
    return $certificado_BeforeShow;
}
//End Close certificado_BeforeShow
?>
