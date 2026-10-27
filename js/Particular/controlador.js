$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../../ajax/Particular/listar.php',
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
		$('#viewCorrespondenciaModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vfolio = button.data('vfolio') ;
		  $('#view_folio').text(vfolio);
		   $('#folio').val(vfolio);
		  var vfrecep = button.data('vfrecep');  
		  $('#view_f_recepcion').text(vfrecep);
		  var vnofi = button.data('vnofi'); 
		  $('#view_num_oficio').text(vnofi);
		  var vfofi = button.data('vfofi');
		  $('#view_f_oficio').text(vfofi);
		  var vtofi = button.data('vtofi'); 
		  $('#view_t_oficio').prop('checked',true);;
		  var vidremi = button.data('vidremi'); 
		  $('#view_id_remitente').text(vidremi);
		  var vcargorem = button.data('vcargorem'); 
		  $('#view_cargo').text(vcargorem);
		  var vnomrem = button.data('vnomrem'); 
		  $('#view_nombre').text(vnomrem);
		  var viddest = button.data('viddest') ;
		  $('#view_enviadopor').text(viddest);
		  var vcargodest = button.data('vcargodest'); 
		  $('#view_cargodest').text(vcargodest);			
		  var vasuntodoc = button.data('vasuntodoc'); 
		  $('#view_asunto').val(vasuntodoc);
		  var vanexodest = button.data('vanexodest'); 
		  $('#view_anexo').text(vanexodest);
		  var vindidest = button.data('vindidest'); 
		  $('#view_indica').text(vindidest);
		  var viddirec = button.data('viddirec'); 
		  $('#view_areainterna').text(viddirec);
		  var idirecciones = button.data('idirecciones');
		 /*$('#keep-order').multiSelect('deselect_all');
		  $('#keep-order').val(idirecciones).multiSelect();*/
		  var vfturnado = button.data('vfturnado'); 
		  $('#view_f_turnado').text(vfturnado);
		  var vfreceparea = button.data('vfreceparea');
		  $('#view_f_recepArea').text(vfreceparea);
		  var vinstdir = button.data('vinstdir'); 
		  $('#view_instruc').val(vinstdir);
		  var vobs = button.data('vobs'); 
		  $('#view_obs').text(vobs);
			//direcciones
		  var direcciones= button.data('direcciones');
		   $('#direcciones12').text(direcciones);
			//direcciones
		  var vstatus = button.data('vstatus'); 
		  $('#view_status').val(vstatus);
		  var vfcapt = button.data('vfcapt'); 
		  $('#view_f_Capt').val(vfcapt);
		  var vid = button.data('vid'); 
		  $('#view_id').val(vid);
	})
		$( "#edit_mja01s" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../../Modelo/mja01/editar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editProductModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
	$( "#view_correspondencia" ).submit(function( event ) {
		 var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../../ajax/Particular/Autorizar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(parseInt(document.getElementById("numpag").value));
					$('#viewCorrespondenciaModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});	
function Guardar_cambios(){
	var url = '../../ajax/Particular/guardar_cambios.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#view_correspondencia').serialize(),
		success: function(registro){
		alert("Guardado con exito");
		load(parseInt(document.getElementById("numpag").value));	
			return false;
		}
	});
	return false;
}