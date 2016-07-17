<?php
//Include Common Files @1-C6BD4A25
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "certificados.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridcertificados { //certificados class @2-B9AE8039

//Variables @2-21D98F71

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
    var $Sorter_nro;
    var $Sorter_nombre;
    var $Sorter_fecha;
    var $Sorter_sexo;
    var $Sorter_tipodoc;
    var $Sorter_nrodoc;
//End Variables

//Class_Initialize Event @2-52BC9620
    function clsGridcertificados($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "certificados";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid certificados";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscertificadosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 1000;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 1000)
            $this->PageSize = 1000;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("certificadosOrder", "");
        $this->SorterDirection = CCGetParam("certificadosDir", "");

        $this->nro = & new clsControl(ccsLabel, "nro", "nro", ccsText, "", CCGetRequestParam("nro", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->fecha = & new clsControl(ccsLabel, "fecha", "fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->sexo = & new clsControl(ccsLabel, "sexo", "sexo", ccsText, "", CCGetRequestParam("sexo", ccsGet, NULL), $this);
        $this->tipodoc = & new clsControl(ccsLabel, "tipodoc", "tipodoc", ccsText, "", CCGetRequestParam("tipodoc", ccsGet, NULL), $this);
        $this->nrodoc = & new clsControl(ccsLabel, "nrodoc", "nrodoc", ccsText, "", CCGetRequestParam("nrodoc", ccsGet, NULL), $this);
        $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "resultado.php";
        $this->Sorter_nro = & new clsSorter($this->ComponentName, "Sorter_nro", $FileName, $this);
        $this->Sorter_nombre = & new clsSorter($this->ComponentName, "Sorter_nombre", $FileName, $this);
        $this->Sorter_fecha = & new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_sexo = & new clsSorter($this->ComponentName, "Sorter_sexo", $FileName, $this);
        $this->Sorter_tipodoc = & new clsSorter($this->ComponentName, "Sorter_tipodoc", $FileName, $this);
        $this->Sorter_nrodoc = & new clsSorter($this->ComponentName, "Sorter_nrodoc", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-FEEB0E11
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_protocolo"] = CCGetFromGet("s_protocolo", NULL);
        $this->DataSource->Parameters["urls_nrodoc"] = CCGetFromGet("s_nrodoc", NULL);
	$this->DataSource->Parameters["urls_afiliado"] = CCGetFromGet("s_afiliado", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["nro"] = $this->nro->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["sexo"] = $this->sexo->Visible;
            $this->ControlsVisible["tipodoc"] = $this->tipodoc->Visible;
            $this->ControlsVisible["nrodoc"] = $this->nrodoc->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->nro->SetValue($this->DataSource->nro->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->sexo->SetValue($this->DataSource->sexo->GetValue());
                $this->tipodoc->SetValue($this->DataSource->tipodoc->GetValue());
                $this->nrodoc->SetValue($this->DataSource->nrodoc->GetValue());
                $this->Link1->Parameters = "";
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "s_nro", $this->DataSource->f("nro"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nro->Show();
                $this->nombre->Show();
                $this->fecha->Show();
                $this->sexo->Show();
                $this->tipodoc->Show();
                $this->nrodoc->Show();
                $this->Link1->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Sorter_nro->Show();
        $this->Sorter_nombre->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_sexo->Show();
        $this->Sorter_tipodoc->Show();
        $this->Sorter_nrodoc->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-23A056CC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nro->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sexo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipodoc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodoc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End certificados Class @2-FCB6E20C

class clscertificadosDataSource extends clsDBConnection1 {  //certificadosDataSource Class @2-8BED88C2

//DataSource Variables @2-B34BE6F0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $nro;
    var $nombre;
    var $fecha;
    var $sexo;
    var $tipodoc;
    var $nrodoc;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-04AFB6AB
    function clscertificadosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid certificados";
        $this->Initialize();
        $this->nro = new clsField("nro", ccsText, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, $this->DateFormat);
        
        $this->sexo = new clsField("sexo", ccsText, "");
        
        $this->tipodoc = new clsField("tipodoc", ccsText, "");
        
        $this->nrodoc = new clsField("nrodoc", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-EA5A3A08
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nro" => array("nro", ""), 
            "Sorter_nombre" => array("nombre", ""), 
            "Sorter_fecha" => array("fecha", ""), 
            "Sorter_sexo" => array("sexo", ""), 
            "Sorter_tipodoc" => array("tipodoc", ""), 
            "Sorter_nrodoc" => array("nrodoc", "")));
    }
//End SetOrder Method

//Prepare Method @2-419238A6
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_protocolo", ccsText, "", "", $this->Parameters["urls_protocolo"], Z, false);
        $this->wp->AddParameter("2", "urls_nrodoc", ccsText, "", "", $this->Parameters["urls_nrodoc"], 0, false);
        $this->wp->AddParameter("3", "urls_afiliado", ccsText, "", "", $this->Parameters["urls_afiliado"], Z, false);
    }
//End Prepare Method

//Open Method @2-787502E6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM certificados,clave\n" .
        "WHERE (replace(nro,' ','') = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' \n" .
        "and (nrodoc = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' OR clave = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' ))
	OR afiliado = '".$this->SQLValue($this->wp->GetDBValue("3"), ccsText)."'";
        $this->SQL = "SELECT * \n" .
        "FROM certificados,clave\n" .
        "WHERE (replace(nro,' ','') = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' \n" .
        "and (nrodoc = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' OR clave = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' ))
	 OR afiliado = '".$this->SQLValue($this->wp->GetDBValue("3"), ccsText)."'";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A30B4572
    function SetValues()
    {
        $this->nro->SetDBValue($this->f("nro"));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->sexo->SetDBValue($this->f("sexo"));
        $this->tipodoc->SetDBValue($this->f("tipodoc"));
        $this->nrodoc->SetDBValue($this->f("nrodoc"));
    }
//End SetValues Method

} //End certificadosDataSource Class @2-FCB6E20C

//Initialize Page @1-17DBFB5A
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "certificados.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A4B3871D
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$certificados = & new clsGridcertificados("", $MainPage);
$MainPage->certificados = & $certificados;
$certificados->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-C7F0CB99
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($certificados);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A2E4BA38
$certificados->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
str_replace($main_block,"{afiliado}",CCGetFromGet("s_afiliado",""));
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FEEC9AA1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($certificados);
unset($Tpl);
//End Unload Page


?>
