// JavaScript Document$(document).ready(pagination(1));
$(function(){
	$('#bd-desde').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var datoSuc = $('#id_suc').val();
		var url = '../php/busca_producto_fecha.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta+'&datoSuc='+datoSuc,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	//********************************
	
	$('#nuevo-producto').on('click',function(){
		$('#formulario-Producto')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
//************************************************
	//BUSCA VALE POR FOLIO Y FECHA
		$('#busca_vale').on('keyup',function(){
		var datovale = $('#busca_vale').val();
		var url = '../php/busca_vale_folio.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'datovale='+datovale,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	// FIN VALE POR FOLIO Y FECHA
//**********************************
	
});


// AGREAGA GRANJA
function agregaProducto(){
	var url = '../php/productos/agrega_productos.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario-Producto').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#mensaje').addClass('alert alert-success text-center').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#formulario-Producto').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('alert alert-warning text-center').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#registra-producto').html(registro);
			return false;
			}
		}
	});
	return false;
}
//FIN AGREGA GRANJA

function Elimina_granja(id){
	var url = '../php/Elimina_granja.php';
	var pregunta = confirm('¿Esta seguro de eliminar esta Categoria?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-registros').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

//Editar Granja
function editarGranja(id){
	$('#formularioGranja')[0].reset();
	var url = '../php/edita_granja.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg').hide();
				$('#edi').show();
				$('#pro').val('Edicion');
				$('#id-prod').val(id);
			    $('#nombre_categoria').val(datos[0]);
				$('#registra-granja').modal({
			         show:true,
			       backdrop:'static'
		        });
			
			return false;
		}
	});
	return false;
}
//fin editar granja
function editarProducto(id){
	$('#formulario')[0].reset();
	var url = '../php/edita_producto.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg').hide();
				$('#edi').show();
				$('#pro').val('Edicion');
				$('#id-prod').val(id);
				$('#nom_chofer').val(datos[0]);
				$('#status').val(datos[1]);
				$('#registra-producto').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function pagination(partida){
	var url = '../php/paginarProducto.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}