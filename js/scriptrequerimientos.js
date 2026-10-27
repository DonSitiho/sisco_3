		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_requerimientos.php',
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
		$('#editRequerimientoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
			var idprog = button.data('idprog') 
			$('#edit_idprog').val(idprog)
			var nombre = button.data('nombre') 
			$('#edit_nombre').val(nombre)
			var numpasxc = button.data('numpas') 
			$('#edit_numpasxc').val(numpasxc)			
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})

		$('#deleteRequerimientoModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})
		
			
		$( "#edit_requerimiento" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_requerimiento.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editRequerimientoModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_requerimiento" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_requerimiento.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addRequerimientoModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_requerimiento" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/eliminar_requerimiento.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deleteRequerimientoModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});