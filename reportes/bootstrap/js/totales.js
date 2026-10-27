$(document).on('ready',constructor);
function constructor(){
	SumarEntradas();
}

function SumarEntradas(){
	$('#contenido').on('change','#precio_publico , #precio_proveedor',function(){
		
		var precio_publico=$('#precio_publico').val();
		
		var precio_proveedor=$('#precio_proveedor').val();
		
		$('#total').val(precio_publico - precio_proveedor);
		
		
	});
}