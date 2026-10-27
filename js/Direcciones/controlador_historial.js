
$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var query1=$("#q1").val();
			var fremte = $("#filtro_remitente").val();
			var nivel1 = $("#id_nivel1").val();
			var nivel2 = $("#id_nivel2").val();
			var nivel3 = $("#id_nivel3").val();
			var nivel4 = $("#id_nivel4").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'query1':query1,'fremte':fremte,'nivel1':nivel1,'nivel2':nivel2,'nivel3':nivel3,'nivel4':nivel4,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../../ajax/Direcciones/listar_historial.php',
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
		
		$('#viewCorrespondenciaModalSeguimiento').on('show.bs.modal', function (event) {
		  
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vfolio = button.data('vfolio') ;
			 $("#resultados12").hide();
	             $("#btnfinalizar").show();
			   $("#btnSeguimiento").show();
			
		  $('#view_folio').text(vfolio);
		  var vfrecep = button.data('vfrecep');  
		  $('#view_f_recepcion').text(vfrecep);
		  var vnofi = button.data('vnofi'); 
		  $('#view_num_oficio').text(vnofi);
		  var vfofi = button.data('vfofi');
		  $('#view_f_oficio').text(vfofi);
			
			var vfolioinput = button.data('vfolio') ;
		  $('#view_folio_input').val(vfolioinput);
			
			var vtofinput = button.data('vtofi'); 
		  $('#view_t_oficioinput').val(vtofinput);
			
		  var vtofi = button.data('vtofi'); 
		  $('#view_t_oficio').prop('checked',true);;
			//select
			var videst = button.data('videst') 
			$('#estatus').val(videst).trigger('change')
			//fin
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
		  var vid = button.data('vid'); 
		  $('#view_id').val(vid);
			
	})
	
$( "#finalizar_Seguimiento" ).submit(function( event ) {		
	
				var parametros = new FormData($("#finalizar_Seguimiento")[0]);
	 var pregunta = confirm('¿Esta seguro de Finalizar esta Correspondencia?');
	if(pregunta==true){
	             $("#finalizar_Seguimiento")[0].reset();
	            $.ajax({
						type: "POST",
						data: parametros,						
						url: "../../ajax/Direcciones/finalizar_Seguimiento.php", //modificar
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
						
						$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
							$("#btnfinalizar").hide();
						},
						success: function(datos){
						$("#resultados").html(datos);																
						load(1);						
						$('#viewCorrespondenciaModalSeguimiento').modal('hide');
					  }
				});
			}else{
		return false;
	}
			  event.preventDefault();
			});	
	
	function Seguimiento(){
	
				var parametros = new FormData($("#finalizar_Seguimiento")[0]);
	             $("#finalizar_Seguimiento")[0].reset();
	            $.ajax({
						type: "POST",
						data: parametros,						
						url: "../../ajax/Direcciones/Adjuntar_seguimiento.php", //modificar
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
						$('#viewCorrespondenciaModalSeguimiento').modal('hide');
					  }
				});
			  event.preventDefault();
}

	
		$( "#edit_correspondencia" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../../ajax/Direcciones/Editar_estatus.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#viewCorrespondenciaModalSeguimiento').modal('hide');
				  }
			});
		  event.preventDefault();
		});
$( "#delete_archivo" ).submit(function( event ) {
				var parametros = $(this).serialize();
				$.ajax({
					type: "POST",
					url: "",
					data: parametros,
					beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					  success: function(datos){
						  $("#resultados").html(datos);
						  load(1);
						  $('#eliminarArchivoModal').modal('hide');
					  }
				  });
				  event.preventDefault();
			  });




	