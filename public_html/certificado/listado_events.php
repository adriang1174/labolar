<?php
//BindEvents Method @1-4E395DEA
function BindEvents()
{
    global $certificadosSearch;
    $certificadosSearch->s_nrodoc->CCSEvents["OnValidate"] = "certificadosSearch_s_nrodoc_OnValidate";
}
//End BindEvents Method

//certificadosSearch_s_nrodoc_OnValidate @6-53A3B623
function certificadosSearch_s_nrodoc_OnValidate(& $sender)
{
    $certificadosSearch_s_nrodoc_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $certificadosSearch; //Compatibility
//End certificadosSearch_s_nrodoc_OnValidate

//Regular Expression Validation @8-8C2D2DCB
    global $CCSLocales;
    if (CCStrLen($Container->s_nrodoc->GetText()) && !preg_match("/[0-9]/", $Container->s_nrodoc->GetText()))
    {
        $Container->s_nrodoc->Errors->addError("Sólo pueden ingresarse valores numéricos");
    }
//End Regular Expression Validation

//Close certificadosSearch_s_nrodoc_OnValidate @6-F2C6D03C
    return $certificadosSearch_s_nrodoc_OnValidate;
}
//End Close certificadosSearch_s_nrodoc_OnValidate


?>
