function enviar(protocolo){
submitForm(protocolo);
}
 
// function to handle form submit
function submitForm(protocolo){
//	 alert("Submitting.....");
     var idContactForm = 'form#contactForm_' + protocolo;
	 var idModal = '#contact-modal_' + protocolo;
	 
	 $.ajax({
		type: "POST",
		url: "mail.php",
		cache:false,
		data: $(idContactForm).serialize(),
		success: function(response){
			//alert(response);
			$(idModal).modal('hide');
			$('#txtmessage').html(response);
		},
		error: function(){
			alert("Error");
		}
	});
}