		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_pasantes.php',
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
		$('#editPasanteModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
			var sexo = button.data('sexo') 
			$('#edit_sexo').val(sexo)
			var ap = button.data('ap') 
			$('#edit_ap').val(ap)
			var am = button.data('am') 
			$('#edit_am').val(am)
			var nombre = button.data('nombre') 
			$('#edit_nombre').val(nombre)
			var domi = button.data('domi') 
			$('#edit_domi').val(domi)
			var col = button.data('col') 
			$('#edit_col').val(col)
			var pob = button.data('pob') 
			$('#edit_pob').val(pob)
			var mpio = button.data('mpio') 
			$('#edit_mpio').val(mpio)
		  var tel = button.data('tel') 
			$('#edit_tel').val(tel)
			var fnac = button.data('fnac') 
			$('#edit_fnac').val(fnac)
			var carr = button.data('carr') 
			$('#edit_carr').val(carr)
			var aest = button.data('aest') 
			$('#edit_aest').val(aest)
			var inst = button.data('inst') 
			$('#edit_inst').val(inst)
		  var email = button.data('email') 
			$('#edit_email').val(email)
			var iddep = button.data('iddep') 
			$('#edit_iddep').val(iddep)
			var idprog = button.data('idprog') 
			$('#edit_idprog').val(idprog)
			var fini = button.data('fini') 
			$('#edit_fini').val(fini)
			var ffin = button.data('ffin') 
			$('#edit_ffin').val(ffin)
			var hrs = button.data('hrs') 
			$('#edit_hrs').val(hrs)			
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})

		$('#deletePasanteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})
		
			
		$( "#edit_pasante" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_pasante.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editPasanteModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_pasante" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_pasante.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#addPasanteModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_pasante" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/eliminar_pasante.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#deletePasanteModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});

	