		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var query2=$("#q1").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'query2':query2,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../../ajax/Direcciones/listar_consulta.php',
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

		
	
	
			



