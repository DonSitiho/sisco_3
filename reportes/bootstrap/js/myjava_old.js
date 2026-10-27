
$(function(){

	//// Busca por Granjas
		$('#bs-dependencia').on('keyup',function(){
		var datoDep = $('#bs-dependencia').val();
		var url = '../php/busca_dep.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'datoDep='+datoDep,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	// fin busca por granjas

	
});
