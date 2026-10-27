
$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var query1=$("#q1").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'query1':query1,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../../ajax/Direcciones/listar.php',
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html("Cargando...");
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		
		$('#viewCorrespondenciaModal').on('show.bs.modal', function (event) {
		  
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vfolio = button.data('vfolio') ;
			 $("#resultados12").hide();
	             $("#btnfinalizar").show();
			$("#btnDarSeguimiento").show();
			
		  $('#view_folio').text(vfolio);
		  var vfrecep = button.data('vfrecep');
		  var vfolioinput = button.data('vfolio') ;
		  $('#view_folio_input').val(vfolioinput);
		  $('#view_f_recepcion').text(vfrecep);
		  var vnofi = button.data('vnofi'); 
		  $('#view_num_oficio').text(vnofi);
		  var vfofi = button.data('vfofi');
		  $('#view_f_oficio').text(vfofi);
				
		  var vtofi = button.data('vtofi'); 
		  $('#view_t_oficio').prop('checked',true);
			
		var vtofinput = button.data('vtofi'); 
		  $('#view_t_oficioinput').val(vtofinput);
			
		  var vidremi = button.data('vidremi'); 
		  $('#view_id_remitente').text(vidremi);
		  var vcargorem = button.data('vcargorem'); 
		  $('#view_cargo').text(vcargorem);
		  var vnomrem = button.data('vnomrem'); 
		  $('#view_nombre').text(vnomrem);
		  var viddest = button.data('viddest') ;
		  $('#view_enviadopor').text(viddest);
		  var vcargodest = button.data('vcargodest'); 
		  $('#view_cargodest').text(vcargodest);			
		  var vasuntodoc = button.data('vasuntodoc'); 
		  $('#view_asunto').text(vasuntodoc);
		  var vanexodest = button.data('vanexodest'); 
		  $('#view_anexo').text(vanexodest);
		  var vindidest = button.data('vindidest'); 
		  $('#view_indica').text(vindidest);
		  var viddirec = button.data('viddirec'); 
		  $('#view_areainterna').text(viddirec);
		 var idirecciones = button.data('idirecciones');
		 	$('#keep-order').multiSelect('deselect_all');
		 $('#keep-order').val(idirecciones).multiSelect();
		  var vfturnado = button.data('vfturnado'); 
		  $('#view_f_turnado').text(vfturnado);
		  var vfreceparea = button.data('vfreceparea');
		  $('#view_f_recepArea').text(vfreceparea);
		  var vinstdir = button.data('vinstdir'); 
		  $('#view_instruc').text(vinstdir);
		  var vobs = button.data('vobs'); 
		  $('#view_obs').text(vobs);
		  var vstatus = button.data('vstatus'); 
		  $('#view_status').val(vstatus);
         
		  var vfcapt = button.data('vfcapt'); 
		  $('#view_f_Capt').val(vfcapt);
		  //Nomsubdireccion
		  var vnomsubdir = button.data('vnomsubdir')
		  $('#view_subdireccion').text(vnomsubdir)
		  //Nom Departamento
		  var vnomdepto = button.data('vnomdepto')
		  $('#view_depto').text(vnomdepto)

		  var vid = button.data('vid'); 
		  $('#view_id').val(vid);
			
	})
	$('#viewCorrespondenciaModalCopia').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vfolio = button.data('vfolio') ;
		  $('#view_folioC').text(vfolio);
		  var vfrecep = button.data('vfrecep');  
		  $('#view_f_recepcionC').text(vfrecep);
		  var vnofi = button.data('vnofi'); 
		  $('#view_num_oficioC').text(vnofi);
		  var vfofi = button.data('vfofi');
		  $('#view_f_oficioC').text(vfofi);
				
		  var vtofi = button.data('vtofi'); 
		  $('#view_t_oficioC').prop('checked',true);;
				
		  var vidremi = button.data('vidremi'); 
		  $('#view_id_remitenteC').text(vidremi);
		  var vcargorem = button.data('vcargorem'); 
		  $('#view_cargoC').text(vcargorem);
		  var vnomrem = button.data('vnomrem'); 
		  $('#view_nombreC').text(vnomrem);
		  var viddest = button.data('viddest') ;
		  $('#view_enviadoporC').text(viddest);
		  var vcargodest = button.data('vcargodest'); 
		  $('#view_cargodestC').text(vcargodest);			
		  var vasuntodoc = button.data('vasuntodoc'); 
		  $('#view_asuntoC').text(vasuntodoc);
		  var vanexodest = button.data('vanexodest'); 
		  $('#view_anexoC').text(vanexodest);
		  var vindidest = button.data('vindidest'); 
		  $('#view_indicaC').text(vindidest);
		  var viddirec = button.data('viddirec'); 
		  $('#view_areainternaC').text(viddirec);
		 var idirecciones = button.data('idirecciones');
		 	$('#keep-orderC').multiSelect('deselect_all');
		 $('#keep-orderC').val(idirecciones).multiSelect();
		  var vfturnado = button.data('vfturnado'); 
		  $('#view_f_turnadoC').text(vfturnado);
		  var vfreceparea = button.data('vfreceparea');
		  $('#view_f_recepAreaC').text(vfreceparea);
		  var vinstdir = button.data('vinstdir'); 
		  $('#view_instrucC').text(vinstdir);
		  var vobs = button.data('vobs'); 
		  $('#view_obsC').text(vobs);
		  var vstatus = button.data('vstatus'); 
		  $('#view_statusC').val(vstatus);
		  var vfcapt = button.data('vfcapt'); 
		  $('#view_f_CaptC').val(vfcapt);
		  var vid = button.data('vid'); 
		  $('#view_idC').val(vid);
			
	})
	$('#turnarCorrespondenciaModal').on('show.bs.modal', function (event) {
		  
		var button = $(event.relatedTarget); // Button that triggered the modal
		var vfolio = button.data('vfolio') ;
		   $("#resultados12").hide();
			   $("#btnfinalizar").show();
		  $("#btnDarSeguimiento").show();
		  
		$('#view_folioT').text(vfolio);
		var vfrecep = button.data('vfrecep');
		
		$('#view_f_recepcionT').text(vfrecep);
		var vnofi = button.data('vnofi'); 
		$('#view_num_oficioT').text(vnofi);
		var vfofi = button.data('vfofi');
		$('#view_f_oficioT').text(vfofi);
			  
		var vtofi = button.data('vtofi'); 
		$('#view_t_oficioT').prop('checked',true);
		  
	  var vtofinput = button.data('vtofi'); 
		$('#view_t_oficioinputT').val(vtofinput);
		  
		var vidremi = button.data('vidremi'); 
		$('#view_id_remitenteT').text(vidremi);
		var vcargorem = button.data('vcargorem'); 
		$('#view_cargoT').text(vcargorem);
		var vnomrem = button.data('vnomrem'); 
		$('#view_nombreT').text(vnomrem);
		var viddest = button.data('viddest') ;
		$('#view_enviadoporT').text(viddest);
		var vcargodest = button.data('vcargodest'); 
		$('#view_cargodestT').text(vcargodest);			
		var vasuntodoc = button.data('vasuntodoc'); 
		$('#view_asuntoT').text(vasuntodoc);
		var vanexodest = button.data('vanexodest'); 
		$('#view_anexoT').text(vanexodest);
		var vindidest = button.data('vindidest'); 
		$('#view_indicaT').text(vindidest);
		var viddirec = button.data('viddirec'); 
		$('#view_areainternaT').text(viddirec);
	   var idirecciones = button.data('idirecciones');
		   $('#keep-orderT').multiSelect('deselect_all');
	   $('#keep-orderT').val(idirecciones).multiSelect();
		var vfturnado = button.data('vfturnado'); 
		$('#view_f_turnadoT').text(vfturnado);
		var vfreceparea = button.data('vfreceparea');
		$('#view_f_recepAreaT').text(vfreceparea);
		var vinstdir = button.data('vinstdir'); 
		$('#view_instrucT').text(vinstdir);
		var vobs = button.data('vobs'); 
		$('#view_obsT').text(vobs);
		var vstatus = button.data('vstatus'); 
		$('#view_statusT').val(vstatus);
	   
		var vfcapt = button.data('vfcapt'); 
		$('#view_f_CaptT').val(vfcapt);
		var vid = button.data('vid'); 
		$('#view_idT').val(vid);
		  
  })

  $( "#turnar_correspondencia" ).submit(function( event ) {		
	
	var parametros = new FormData($("#turnar_correspondencia")[0]);
	var pregunta = confirm('¿Esta seguro de Turnar esta Correspondencia?');

if(pregunta==true){
	 $("#turnar_correspondencia")[0].reset();
	$.ajax({
			type: "POST",
			data: parametros,						
			url: "../../ajax/Direcciones/turnar_correspondencia.php", //modificar
			contentType: false,
			processData: false,
			beforeSend: function(objeto){
			
			$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
				$("#btnfinalizar").hide();
			},
			success: function(datos){
			$("#resultados").html(datos);																
			load(1);						
			$('#turnarCorrespondenciaModal').modal('hide');
		  }
	});
}else{
return false;
}
  event.preventDefault();
});

		
		
$( "#finalizar_correspondencia" ).submit(function( event ) {		
	
				var parametros = new FormData($("#finalizar_correspondencia")[0]);
	            var pregunta = confirm('¿Esta seguro de Finalizar esta Correspondencia?');
	
	if(pregunta==true){
	             $("#finalizar_correspondencia")[0].reset();
	            $.ajax({
						type: "POST",
						data: parametros,						
						url: "../../ajax/Direcciones/finalizar_original.php", //modificar
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
						
						$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
							$("#btnfinalizar").hide();
						},
						success: function(datos){
						$("#resultados").html(datos);																
						load(1);						
						$('#viewCorrespondenciaModal').modal('hide');
					  }
				});
	}else{
		return false;
	}
			  event.preventDefault();
			});	
$( "#finalizar_correspondencia_copia" ).submit(function( event ) {
		 var parametros = $(this).serialize();
	 var pregunta = confirm('¿Esta seguro de Finalizar esta Correspondencia?');
	if(pregunta==true){
			$.ajax({
					type: "POST",
					url: "../../ajax/Direcciones/finalizar_copia.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados1C").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados1C").html(datos);
					load(1);
					
					$('#viewCorrespondenciaModalCopia').modal('hide');
					
				  }
			});
		}else{
		return false;
	}
		  event.preventDefault();
		});	

	function DarSeguimiento(){
	
				var parametros = new FormData($("#finalizar_correspondencia")[0]);
	             $("#finalizar_correspondencia")[0].reset();
	            $.ajax({
						type: "POST",
						data: parametros,						
						url: "../../ajax/Direcciones/Dar_seguimiento.php", //modificar
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
						
						$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
							$("#btnfinalizar").hide();
							$("#btnDarSeguimiento").hide();
						},
						success: function(datos){
						$("#resultados").html(datos);																
						load(1);						
						$('#viewCorrespondenciaModal').modal('hide');
					  }
				});
			  event.preventDefault();
}

function TurnarDireccion(){
	//alert('ENTRO');
	
	var parametros = new FormData($("#finalizar_correspondencia")[0]);
	 $("#finalizar_correspondencia")[0].reset();
	$.ajax({
			type: "POST",
			data: parametros,						
			url: "../../ajax/Direcciones/turnar_direcciones.php", //modificar
			contentType: false,
			processData: false,
			beforeSend: function(objeto){
			
			$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
				$("#btnfinalizar").hide();
				$("#btnSeguimiento").hide();
			},
			success: function(datos){
			$("#resultados").html(datos);																
			load(1);						
			$('#viewCorrespondenciaModal').modal('hide');
		  }
	});
  event.preventDefault();
}

function cortar_string($string, $largo) {
	$marca = "<!--corte-->";

	if (strlen($string) > $largo) {

		$string = wordwrap($string, $largo, $marca);
		$string = explode($marca, $string);
		$string = $string[0];
	}
	return $string;

 }
