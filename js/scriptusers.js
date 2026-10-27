		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_users.php',
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
		
		$('#editUserModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal		  
		  var nom = button.data('nom') 
		  $('#edit_nomuser').val(nom)
		  var app = button.data('app') 
		  $('#edit_apuser').val(app)
		  var apm = button.data('apm') 
		  $('#edit_amuser').val(apm)
		  var nick = button.data('nick') 
		  $('#edit_nickuser').val(nick)
		  var pass = button.data('pass') 
		  $('#edit_pasuser').val(pass)	
		  var idir = button.data('idir') 
		  $('#edit_diruser').val(idir)	
		  var nivel = button.data('nivel') 
		  $('#edit_nivuser').val(nivel)			  		  
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})		
		
		$('#deleteUserModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})
		
		$( "#edit_user" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_user.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editUserModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#add_user" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_user.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addUserModal').modal('hide');
					$('#add_user').trigger("reset");
				  }
			});
		  event.preventDefault();
		});		

		$( "#delete_user" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/eliminar_user.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deleteUserModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});