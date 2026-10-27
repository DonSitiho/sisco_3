		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_unireceptoras.php',
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
		$('#editUnireceptoraModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal			
			var nombre = button.data('nombre') 
			$('#edit_name').val(nombre)
			var domi = button.data('domi') 
			$('#edit_domi').val(domi)
			var col = button.data('col') 
			$('#edit_col').val(col)
		  var pob = button.data('pob') 
		  $('#edit_pob').val(pob)
		  var mpio = button.data('mpio') 
			$('#edit_mpio').val(mpio)
			var idprest = button.data('idprest') 
			$('#edit_idprest').val(idprest)		
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})

		$('#deleteUnireceptoraModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})
		
			
		$( "#edit_unireceptora" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_unireceptora.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editUnireceptoraModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_unireceptora" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_unireceptora.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addUnireceptoraModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_unireceptora" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/eliminar_unireceptora.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deleteUnireceptoraModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});