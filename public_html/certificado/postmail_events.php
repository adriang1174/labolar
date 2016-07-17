<?php
//BindEvents Method @1-493CAFFD
function BindEvents()
{
    global $Label1;
    $Label1->CCSEvents["BeforeShow"] = "Label1_BeforeShow";
}
//End BindEvents Method

//Label1_BeforeShow @2-62EBFD0A
function Label1_BeforeShow(& $sender)
{
    $Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Label1; //Compatibility
//End Label1_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
    if(CCGetParam('r','') == 'OK')
	{
		$Label1->SetValue('Mensaje enviado exitosamente');
	}
	else
	{
		$Label1->SetValue('No se ha podido enviar el mensaje. Error: '.CCGetParam('t',''));
	}
// -------------------------
//End Custom Code

//Close Label1_BeforeShow @2-B48DF954
    return $Label1_BeforeShow;
}
//End Close Label1_BeforeShow


?>
