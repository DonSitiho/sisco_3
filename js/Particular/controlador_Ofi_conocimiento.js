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
				url:'../../ajax/Particular/listar_Ofi_conocimiento.php',
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
			buscaofi(1);
		});
		function buscaofi(page){
			var query=$("#qq").val();			
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader2").fadeIn('slow');
			$.ajax({
				url:'../../ajax/Particular/listar_oficios.php',
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
		  $('#id_oficio').val(vid);
			
	})
	function Revisado(){
	
		var parametros = new FormData($("#FormRevisar")[0]);
		 $("#FormRevisar")[0].reset();
		$.ajax({
				type: "POST",
				data: parametros,						
				url: "../../ajax/Particular/revisar_oficio.php", //modificar
				contentType: false,
				processData: false,
				beforeSend: function(objeto){
				
				$("#resultados12").show().html('<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>');
					$("#btnfinalizar").hide();
					$("#btnDarSeguimiento").hide();
				},
				success: function(datos){
				$("#resultados").html(datos);
				$("#resultadosP").html(datos);																
				load(1);
				loadP(1);
				loadR(1);						
				$('#viewCorrespondenciaModalCopia').modal('hide');
			  }
		});
	  event.preventDefault();
}
//Listar PENDIENTES
$(function() {
	loadP(1);
});
function loadP(page){
	// var queryP=$("#qP").val();
	var query1P=$("#q1P").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query1P':query1P,'per_page':per_page};
	$("#loaderP").fadeIn('slow');
	$.ajax({
		url:'../../ajax/Particular/listar_Ofi_conocimiento_Pendientes.php',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loaderP").html("Cargando...");
	  },
		success:function(data){
			$(".outer_divP").html(data).fadeIn('slow');
			$("#loaderP").html("");
		}
	})
}
//Listar Revisados
$(function() {
	loadR(1);
});
function loadR(page){
	// var queryP=$("#qP").val();
	var query1R=$("#q1R").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query1P':query1R,'per_page':per_page};
	$("#loaderR").fadeIn('slow');
	$.ajax({
		url:'../../ajax/Particular/listar_Ofi_conocimiento_Revisados.php',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loaderR").html("Cargando...");
	  },
		success:function(data){
			$(".outer_divR").html(data).fadeIn('slow');
			$("#loaderR").html("");
		}
	})
}

