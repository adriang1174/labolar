<?php 
include('include/header.php');
?>

<script type="text/javascript">
$(document).ready(function() {
  $("#busqueda").validate({
    rules: {
      s_nrodoc : {
        required: true
      },
      s_protocolo: {
        required: true
      }
    },
	messages: {
    s_nrodoc: "Por favor ingrese su número de documento",
    s_protocolo: "Por favor ingrese el número de paciente"
	}
  });
});
</script>

<?php
include('include/container.php');
?>

<div id='av_section_2'  class='avia-section main_color avia-section-default avia-no-border-styling avia-bg-style-scroll  avia-builder-el-3  el_after_av_section  avia-builder-el-last   container_wrap fullsize' style=' '  >
	<div class='container' >
		<div class='template-page content  av-content-full alpha units'>
			<div class='post-entry post-entry-type-page post-entry-149'>
				<div class='entry-content-wrapper clearfix'>
					<div class="flex_column av_two_third  flex_column_div av-zero-column-padding first  avia-builder-el-4  el_before_av_one_third  avia-builder-el-first  " style='border-radius:0px; '>
						<section class="avia_codeblock_section  avia_code_block_0 "  itemscope="itemscope" itemtype="https://schema.org/CreativeWork" >
							<div class='avia_codeblock '  itemprop="text" > 
								<h4>Complete con n&uacute;mero de documento y n&uacute;mero de paciente para buscar sus estudios</h4>
								<div role="form" class="wpcf7" id="wpcf7-f21-p149-o1" lang="en-US" dir="ltr">
									<div class="screen-reader-response">
									</div>
									<form action="certificados.php" name="busqueda" id="busqueda" method="post" class="wpcf7-form" novalidate="novalidate">
										<p>
											<label> Nro. Documento *<br />
												<span class="wpcf7-form-control-wrap ">
													<input type="text" name="s_nrodoc" value="" size="20" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" />
												</span> 
											</label>
										</p>
										<p>
											<label> Nro. Paciente *<br />
												<span class="wpcf7-form-control-wrap ">
													<input type="text" name="s_protocolo" value="" size="20" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" />
												</span>
											</label>
										</p>
										<p>
											<input type="submit" value="CONSULTAR" class="wpcf7-form-control wpcf7-submit avia-button avia-color-theme-color avia-size-medium" />
										</p>
										<div class="wpcf7-response-output wpcf7-display-none">
										</div>
									</form>
								</div>
							</div>


							<div style="font-family: 'Poppins', sans-serif!important; font-size: 13px;">
							<br>
							<br>
							PARA IMPRIMIR SUS RESULTADOS por "Buscar Certificados":
							<br>
							Por favor, tenga a mano su Documento y el " Nº PACIENTE" que le fue asignado al momento de la extracción en el Laboratorio.
							<br><br>
							Ingrese su número de documento en el espacio "Nro. Documento" (sin dejar espacios en blanco) y el número de paciente en el espacio "Nro. Paciente" (este dato figura en el "Talón Paciente", en el margen superior derecho)  ** Por favor ingresarlo sin dejar espacios, por ej: L000000 **
							<br><br>
							Recuerde:
							<br>
							*Para solicitar el envio de sus resultados por correo privado (en este caso con costos a cargo del paciente) puede contactarnos por la web,  por mail a recepcion@laboratorioraffo.com.ar, por Whatsapp al 1161767119 o bien telefónicamente al 4821-1212/4826-0869/4826-4949 de Lunes a Viernes de 8 a 19 hs
							<br>
							</div>


							
							
						</section>
					</div>
					<div class="flex_column av_one_third  flex_column_div   avia-builder-el-6  el_after_av_two_third  el_before_av_one_full  " style='border-width:1px; border-color:#dbdbdb; border-style:solid; padding:20px 20px 20px 20px ; border-radius:24px; '>
						<section class="av_textblock_section "  itemscope="itemscope" itemtype="https://schema.org/CreativeWork" >
							<div class='avia_textblock  '   itemprop="text" >
								<h4>Información de contacto</h4>
								<p><strong>E-mail:</strong> <a href="mailto:recepcion@laboratorioraffo.com.ar">recepcion@laboratorioraffo.com.ar</a></p>
								<p><strong>Whatsapp:</strong> 1161767119</p>
								<p><strong>Teléfonos:</strong> 4821-1212 / 4826-0869 / 4826-4949</p>
								<p><strong>Dirección:</strong> Laprida 1225 PB &#8220;A&#8221;, Ciudad Autónoma de Buenos Aires, Argentina</p>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div><!-- close content main div --> 
	</div><!--end builder template-->
</div><!-- close default .container_wrap element -->						

<?php include('include/footer.php');?>		