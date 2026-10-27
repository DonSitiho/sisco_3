// JavaScript Document
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
				url:'../../ajax/Direcciones/listar_Ofi_conocimiento.php',
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

		$(function() {
			cargar(1);
		});

		function cargar(page1){
			var query2=$("#q2").val();
			var query3=$("#q3").val();
			var per_page1=10;
			var parametros = {"action":"ajax","page1":page1,'query2':query2,'query3':query3,'per_page1':per_page1};
			$("#loader2").fadeIn('slow');
			$.ajax({
				url:'../../ajax/Direcciones/listar_copias_conocimiento.php',
				data: parametros,
				beforeSend: function(objeto){
				$("#loader2").html("Cargando...");
			},
				success:function(data){
					$(".outer_div2").html(data).fadeIn('slow');
					$("#loader2").html("");
				}
			})
		}
		
			
// ************************* miosss ********************
$( "#add_corresp" ).submit(function( event ) {		
	
	var parametros = new FormData($("#add_corresp")[0]);
	var pregunta = confirm('Guardar Cambios???');
		if(pregunta==true){
			$("#add_corresp")[0].reset();
			$.ajax({
					type: "POST",
					data: parametros,						
					url: "../../ajax/Direcciones/add_ofi_conocimiento.php", //modificar
					contentType: false,
					processData: false,
					beforeSend: function(objeto){
					
						$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
						$("#btnfinalizar").hide();
					},
					success: function(datos){
						$("#resultados").html(datos);															
						load(1);						
						$('#addOfi').modal('hide');
						location.reload();

					}
			});
		}else{
			return false;
		}
			event.preventDefault();
});


$( "#add_corresp_resp" ).submit(function( event ) {		
	
	var parametros = new FormData($("#add_corresp_resp")[0]);
	var pregunta = confirm('Guardar Cambios???');
		if(pregunta==true){
			$("#add_corresp_resp")[0].reset();
			$.ajax({
					type: "POST",
					data: parametros,						
					url: "../../ajax/Direcciones/add_ofi_conocimiento_resp.php", //modificar
					contentType: false,
					processData: false,
					beforeSend: function(objeto){
					
						$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
						$("#btnfinalizar").hide();
					},
					success: function(datos){
						$("#resultados").html(datos);															
						cargar(1);						
						$('#addOfiResp').modal('hide');
					}
			});
		}else{
			return false;
		}
			event.preventDefault();
});	


$('#viewCorrespondenciaModalCopia').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		 
	
		  var voficio = button.data('voficio');  
		  $('#view_oficio').val(voficio);

		  var voficio = button.data('voficio');  
		  $('#view_no_referencia').val(voficio);
	
	      var vfecha = button.data('vfecha');  
		  $('#view_fecha').val(vfecha);

		  var vremitente = button.data('vremitente') ;
		  $('#view_remitente').val(vremitente);
	
	      var vasunto = button.data('vasunto');  
		  $('#view_asunto').val(vasunto);
	
	      var vtipodest = button.data('vtipodest');  
		  $('#view_tipo_dest').val(vtipodest);// no se que sea
	
	      var vdestinatario = button.data('vdestinatario');  
		  $('#view_destinatario').val(vdestinatario);

		  if(vtipodest == 0){
		
			var vnombreoriginal = button.data('vnombreoriginal');  
			$('#view_dependencia').val(vnombreoriginal);

		  }else{

			var vnombredep = button.data('vnombredep');  
			$('#view_dependencia').val(vnombredep);

		  }

		  var titularview = button.data('titularview');  
		  $('#view_titular').html(titularview);
		  //alert(titularview );

		 
		  var adireccionescopia = button.data('adireccionescopia');  
		 // $('#view_copias').text(adireccionescopia);

		  $('#resultadosM').html(adireccionescopia);

		  var adireccionesoriginal = button.data('adireccionesoriginal');  
		  // $('#view_copias').text(adireccionescopia);
 
		   $('#resultadosOriginal').html(adireccionesoriginal);
	 
	
	      //alert(adireccionescopia );
	       var vtipo = button.data('vtipo');  
		  $('#view_tipo').val(vtipo);
		 // alert(vtipo);
	
		  var vid = button.data('vid'); 
		  $('#view_idref').val(vid);
			
	})


$('#viewOfiRecibidos').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vremitente1 = button.data('vremitente1') ;
		  $('#view_remitente1').val(vremitente1);
	
		  var voficio1 = button.data('voficio1');  
		  $('#view_oficio1').val(voficio1);
	
	      var vfecha1 = button.data('vfecha1');  
		  $('#view_fecha1').val(vfecha1);
	
	      var vasunto1 = button.data('vasunto1');  
		  $('#view_asunto1').val(vasunto1);
	
	      var vdestinatario1 = button.data('vdestinatario1');  
		  $('#view_destinatario1').val(vdestinatario1);
	
	      var vtipo1 = button.data('vtipo1');  
		  $('#view_tipo1').val(vtipo1);		
		  
		  var vid1 = button.data('vid1'); 
		  $('#view_idC1').val(vid1);
			
})

$('#EditOficio').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vremitente = button.data('vremitente') ;
		  $('#edit_remitente').val(vremitente);
	
		  var voficio = button.data('voficio');  
		  $('#edit_oficio').val(voficio);
	
	      var vfecha = button.data('vfecha');  
		  $('#edit_fecha').val(vfecha);
	
	      var vasunto = button.data('vasunto');  
		  $('#edit_asunto').val(vasunto);
	
	      var vdestinatario = button.data('vdestinatario');  
		  $('#edit_destinatario').val(vdestinatario);
	
	       var vtipo = button.data('vtipo');  
		  $('#edit_tipo').val(vtipo);
		  
		  var vid = button.data('vid'); 
		  $('#edit_idC').val(vid);
			
	})

$('#addOfiResp').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var anoficio1 = button.data('anoficio1');
		  $('#no_referencia_resp').val(anoficio1);
			
		  var aremitente1 = button.data('aremitente1');
		  $('#destinatario_resp').val(aremitente1);
			
		  var arearemitente1 = button.data('arearemitente1');
		  $('#areadestinatario_resp').val(arearemitente1);
			
		  var adireccionescopia = button.data('adireccionescopia');
		  $('#areascopia_resp').val(adireccionescopia);
			
		  var id_dir_orig = button.data('id_dir_orig');
		  $('#id_destino_resp').val(id_dir_orig);
			
		  var aconcopia1 = button.data('aconcopia1');
		  $('#ids_copias_resp').val(aconcopia1);

		  var iddocini = button.data('iddocini');
		  $('#id_doc_ini').val(iddocini);
			
	})

	$('#editOfiResp').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var eremitente1 = button.data('eremitente1') ;
		  $('#eremitente1').val(eremitente1);
	
		  var enoficio1 = button.data('enoficio1');  
		  $('#eno_oficio1').val(enoficio1);
	
	      var efecha1 = button.data('efecha1');  
		  $('#efecha1').val(efecha1);
	
	      var easunto1 = button.data('easunto1');  
		  $('#easunto1').val(easunto1);
	
	      var edestinatario1 = button.data('edestinatario1');  
		  $('#edestinatario1').val(edestinatario1);
	
	       var etipo1 = button.data('etipo1');  
		  $('#etipo1').val(etipo1);
		  
		  var eid1 = button.data('eid1'); 
		  $('#eid1').val(eid1);
			
	})




		$( "#edit_ofi_conocimiento" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../../ajax/Direcciones/editar_ofi_conocimiento.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
						load(1);
					$('#edit_ofi_conocimiento').trigger("reset");
					$('#EditOficio').modal('hide');
					
				  }
			});
		  event.preventDefault();
		});


		$( "#edit_ofi_resp" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../../ajax/Direcciones/editar_ofi_conocimiento.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
						load(1);
					$('#edit_ofi_resp').trigger("reset");
					$('#editOfiResp').modal('hide');
					
				  }
			});
		  event.preventDefault();
		});
	