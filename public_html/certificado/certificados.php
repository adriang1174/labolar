<?php 
include('include/header.php');
?>

<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>		
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />

<script type="text/javascript" src="js/contact.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	var usersData = $('#certList').DataTable({
		"lengthChange": false,
		"searching": false,
		"paging": false,
		"bInfo" : false,
		"processing":true,
		"serverSide":true,
        language: {
            url: 'http://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        },
		"order":[],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{s_nrodoc:'<?= $_POST['s_nrodoc'] ?>',s_protocolo:'<?= $_POST['s_protocolo'] ?>'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2],
				"orderable":false,
			},
		],
	});
	
});


</script>	


<?php include('include/container.php');?>

<div class="container contact">	
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">   
		<table id="certList" class="display" style="width:100%;font-family: 'Poppins', sans-serif!important;">
			<thead>
				<tr>
					<th>Protocolo</th>
					<th>Fecha</th>
					<th></th>
				</tr>
			</thead>
			
		</table>
		<div id="txtmessage"style="width:100%;font-family: 'Poppins', sans-serif!important;"></div>
	</div>

</div>	
<?php include('include/footer.php');?>