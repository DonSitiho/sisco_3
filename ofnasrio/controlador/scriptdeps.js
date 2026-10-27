		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../modelos/listar_dep.php',
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
		
		$('#editDepModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal		  
		  var ident = button.data('ident') 
		  $('#edit_idendep').val(ident)		  		  
		  var sigla = button.data('sigla') 
		  $('#edit_sigladep').val(sigla)		  		  
		  var nombre = button.data('nombre') 
		  $('#edit_nomdep').val(nombre)		  		  		  	  		  
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})		
		
		$('#deleteDepModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})
		
		$( "#edit_dep" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../modelos/editar_dep.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editDepModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#add_dep" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../modelos/guardar_dep.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addDepModal').modal('hide');
					$('#add_dep').trigger("reset");
				  }
			});
		  event.preventDefault();
		});		

		$( "#delete_dep" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../modelos/eliminar_dep.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deleteDepModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});