		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_verprogramas.php',
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
		$('#editProgramaModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
			var iddep = button.data('iddep') 
			$('#edit_iddep').val(iddep)
			var nombre = button.data('nombre') 
			$('#edit_nombre').val(nombre)
			var coord = button.data('coord') 
			$('#edit_coord').val(coord)			
			var edo = button.data('edo') 
			$('#edit_edo').val(edo)		  			
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})

		$('#deleteProgramaModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})
		
			
		$( "#edit_programa" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_programa.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editProgramaModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_programa" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_programa.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addProgramaModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_programa" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/eliminar_programa.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deleteProgramaModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});