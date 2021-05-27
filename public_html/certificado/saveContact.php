<?php
if (isset($_POST['email'])) {
	$email = strip_tags($_POST['email']);
	//echo "<strong>Email</strong>: ".$email."</br>";
	//echo "<strong>Protocolo</strong>: ".$_POST['s_nro']."</br>";
	//echo "<span class='label label-info'>Contact form has been submitted with above details!</span>";	
/*	$str = '<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
					<h4>El informe ha sido enviado a su dirección de correo electrónico: </h4>'.$email.'
				</div>
					<div class="modal-footer">					
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>

			</div>
		</div>';*/
	$str = "El informe ha sido enviado a su dirección de correo electrónico ".$email;
	echo $str;
}
?>