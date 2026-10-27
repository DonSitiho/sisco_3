$(function() {
	load(1);
});
function load(page){
	var query=$("#q").val();
	var query1=$("#q1").val();
	var query2=$("#q2").val();
	var query3=$("#q3").val();
	var query4=$("#q4").val();
	var folio1=$("#folio1").val();
	var folio2=$("#folio2").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'query1':query1,'query2':query2,'query3':query3,'query4':query4,'folio1':folio1,'folio2':folio2,'per_page':per_page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../modelos/listar_c_oficiosrio.php',
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

