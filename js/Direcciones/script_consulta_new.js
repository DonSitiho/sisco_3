// JavaScript Document
$(function() {
	load(1);
});
function load(page){
	var query=$("#q").val();
	var query2=$("#q1").val();
	var query4=$("#q4").val();
	var query5=$("#q5").val();
	var query6=$("#q6").val();
	var direccion=$("#direccion").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'query2':query2,'query4':query4,'query5':query5,'query6':query6,'direccion':direccion,'per_page':per_page};
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

function imprimir(page) {
	var query = $("#q").val();
	var query2 = $("#q1").val();
	var query4 = $("#q4").val();
	var query6 = $("#q6").val();
	var direccion = $("#direccion").val();
	var per_page = 10;
	
	//var query5 = $("#q5").val();
	// Crear la URL con los parámetros
	var url = '../../imprimir_consulta.php?' +
		'action=ajax' +
		'&page=' + page +
		'&query=' + encodeURIComponent(query) +
		'&query2=' + encodeURIComponent(query2) +
		'&query4=' + encodeURIComponent(query4) +
		'&query6=' + encodeURIComponent(query6) +
		'&direccion=' + encodeURIComponent(direccion) +
		'&per_page=' + per_page;
		
		//'&query5=' + encodeURIComponent(query5) +
	// Abrir en una nueva pestaña
	window.open(url, '_blank');
}




	



