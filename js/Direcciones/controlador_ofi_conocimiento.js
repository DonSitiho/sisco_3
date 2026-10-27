		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
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
		
		$('#EditOficio').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal		  
  var vremitente = button.data('vremitente') 
  $('#edit_remitente').val(vremitente)
  		  		  
  var id = button.data('id') 
  $('#id').val(id)
})		
		
		

		
			
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
					  }
				});
			}else{
		return false;
	}
			  event.preventDefault();
			});	

$('#viewCorrespondenciaModalCopia').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vremitente = button.data('vremitente') ;
		  $('#view_remitente').val(vremitente);
	
	
		  var voficio = button.data('voficio');  
		  $('#view_oficio').val(voficio);
	
	      var vfecha = button.data('vfecha');  
		  $('#view_fecha').val(vfecha);
	
	      var vasunto = button.data('vasunto');  
		  $('#view_asunto').val(vasunto);
	
	      var vdestinatario = button.data('vdestinatario');  
		  $('#view_destinatario').val(vdestinatario);
	
	       var vtipo = button.data('vtipo');  
		  $('#view_tipo').val(vtipo);
	
		 
				
		  
		  var vid = button.data('vid'); 
		  $('#view_idC').val(vid);
			
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
	