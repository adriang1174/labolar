<?php

require('include/config.php');
include_once('PHPMailer/class.phpmailer.php');
include('PdfToText.phpclass') ;

class Certificado extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $userTable = 'certificados';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}	

	public function getCertficadoList($s_nrodoc,$s_protocolo){		
		$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE replace(nro , ' ','') = '".$s_protocolo."' AND nrodoc = ".$s_nrodoc. " ORDER BY archivo DESC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		
		$numRows = mysqli_num_rows($result);
		
		$certifData = array();	
		while( $certifs = mysqli_fetch_assoc($result) ) {		
			$certifRows = array();
			$status = '';

			$path = '../archivos/';
			if (!file_exists($path.$certifs['archivo'])) 
				$path = '../archivos.old/';
			
			if (strtolower(substr($path.$certifs['archivo'], -3)) == 'pdf')
			{
				$pdf = new PdfToText ($path.$certifs['archivo']) ;
				//$fecha = date ("d/m/Y", filemtime($path.$certifs['archivo']));
				$pos = strpos($pdf->Text, "Fecha : ") + 8;
				$fecha = substr($pdf->Text,$pos,10);
			}
			else
			{
				$str = file_get_contents($path.$certifs['archivo']);
				$pos = strpos($str, "Fecha : ") + 8;
				$fecha = substr($str,$pos,10);
			}
			

			
			$certifRows[] = $certifs['nro'];
			$certifRows[] = $fecha;
			$certifRows[] = '<div id="contact">
								<a class="avia-color-theme-color av-menu-button-colored avia-size-small btn btn-info" role="button" href="'.$path.$certifs['archivo'].'" target="_blank"> Ver informe <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
								<button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#contact-modal_'.$s_protocolo.'">Enviar por email <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
							</div>
	<div id="contact-modal_'.$s_protocolo.'" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
					<h3>Ingrese su dirección de correo electrónico:</h3>
				</div>
				<form id="contactForm_'.$s_protocolo.'" name="contactForm_'.$s_protocolo.'" role="form">
					<div class="modal-body">				
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" class="form-control">
							<input type="hidden" name="s_nro" class="form-control" value="'.$s_protocolo.'">
						</div>
					</div>
					<div class="modal-footer">					
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-success" id="btnsubmit" onClick="enviar(\''.$s_protocolo.'\')">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
			';
			$certifData[] = $certifRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$certifData,
			"query"				=>  $sqlQuery
		);
		echo json_encode($output);
	}

	public function sendCertficadoEmail($s_nro,$emailAddress){
		$sqlQuery = "SELECT archivo FROM ".$this->userTable." WHERE replace(nro , ' ','') = '".$s_nro."'";
		$response = $this->getData($sqlQuery);
		$archivo = $response[0]['archivo'];

		$mail    = new PHPMailer(); 
		$path = '../archivos/';

		$str = file_get_contents($path.$archivo);
		   if($str===false)
			{
					$path = '../archivos.old/';
					$str = file_get_contents($path.$archivo);
			}

		//Attachments
		if (strtolower(substr($archivo, -3)) == 'pdf')
		{
			$mail->addAttachment($path.$archivo);  
			$body = "Estimado paciente, <br>
					<br>
					  Puede ver sus resultados en el archivo adjunto a este correo. <br>
					<br>
					Atentamente.<br>
					Laboratorios Raffo  ";
		} 
		else
		{   
				$str = Str_replace("\x21", "",$str);
				$str = Str_replace("\x10", "",$str);
				$str = Str_replace("\x1B", "",$str);
				$str = Str_replace("\x08", "",$str);
				$str = Str_replace("\x00", "",$str);
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
				$txt_archivo = $str;

				  $body ="
				  <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
					<tr>
					  <td valign=\"top\">
						<table style=\"border-left: 1px solid #3d84cc; border-bottom: 1px solid #3d84cc;border-right: 1px solid #3d84cc;width: 100%;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
						  <tr>
							<td style=\"background-image: url('http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/HeaderLeft.gif');\">
							<img alt=\"\" src=\"http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/Spacer.gif\" border=\"0\"></td> 
							<td style=\"font-size: 110%; font-weight: bold; text-align: left;	padding: 3px; background-color: #3d84cc; color: #ffffff; width: 100%;	white-space: nowrap;padding-left: 8px;\"><strong>Certificado</strong></td> 
							<td style=\"background-image: url('http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/HeaderRight.gif'); background-position: right top;\"><img alt=\"\" src=\"http://www.laboratorioraffo.com/certificado/Styles/Simple/Images/Spacer.gif\" border=\"0\"></td>
						  </tr>
						</table>
						<table style=\"border-left: 1px solid #3d84cc; border-bottom: 1px solid #3d84cc;border-right: 1px solid #3d84cc;width: 100%;\" cellspacing=\"0\" cellpadding=\"0\">
						  <tr style=\"font-size: 80%; 	text-align: left; vertical-align: top;padding: 3px;	border-top: 1px solid #3d84cc; border-right: 1px solid #3d84cc;	background-color: #dfdfdf; color: #000000;	white-space: nowrap;\">
							<th scope=\"col\"></th>
						  </tr>
						  <tr style=\"font-size: 80%; font-weight: normal; text-align: left; vertical-align: top;	padding: 3px;	border-top: 1px solid #3d84cc; border-right: 1px solid #3d84cc;	background-color: #f7f7f7; color: #000000;	white-space: nowrap;	color: #000000;\">
							<td style=\"FONT-SIZE: 130%; FONT-FAMILY: 'Courier New', Courier, monospace\" width=\"900\"><pre>".$txt_archivo."</pre></td>
						  </tr>
						  <tr style=\"font-size: 80%;	padding: 3px;	border-top: 1px solid #3d84cc; border-right: 1px solid #3d84cc;	background-color: #f7f7f7; color: #000000;	text-align: center;	vertical-align: middle;	white-space: nowrap;	color: #000000;\">
							<td>
							  </td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>
				  ";
		}
		$body =  strval($body);
		$mail->From       = "recepcion@laboratorioraffo.com";
		$mail->FromName   = "Laboratorio Raffo";
		$mail->Subject    = "Envio de certificado";
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML($body);
		$mail->AddAddress($emailAddress);

		if($mail->Send()) 
		  echo "<span class='label label-info'>El certificado se ha enviado a la dirección de correo solicitada.</span>";	
		else 
		  echo "<span class='label label-info'>Se ha producido un error. ".$mail->ErrorInfo."</span>";	
	}
}
?>