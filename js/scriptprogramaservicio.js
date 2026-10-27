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
			var code = button.data('code') 
			$('#edit_code').val(code)
			var nombre = button.data('nombre') 
			$('#edit_name').val(nombre)
			var titu = button.data('titu') 
			$('#edit_titu').val(titu)
			var domi = button.data('domi') 
			$('#edit_domi').val(domi)
			var mpio = button.data('mpio') 
			$('#edit_mpio').val(mpio)
		  var tel = button.data('tel') 
		  $('#edit_tel').val(tel)
		  var email = button.data('email') 
			$('#edit_email').val(email)
			var freg = button.data('freg') 
			$('#edit_freg').val(freg)
			var fact = button.data('fact') 
			$('#edit_fact').val(fact)			
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