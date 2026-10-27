
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
				url:'../../ajax/Direcciones/listar_finalizados.php',
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
		
		
	$('#viewCorrespondenciaModalCopia').on('show.bs.modal', function (event) {
		 
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var vfolio = button.data('vfolio') ;
		  $('#view_folioC').text(vfolio);
		  var vfrecep = button.data('vfrecep');  
		  $('#view_f_recepcionC').text(vfrecep);
		  var vnofi = button.data('vnofi'); 
		  $('#view_num_oficioC').text(vnofi);
		  var vfofi = button.data('vfofi');
		  $('#view_f_oficioC').text(vfofi);
				
		  var vtofi = button.data('vtofi'); 
		  $('#view_t_oficioC').prop('checked',true);;
				
		  var vidremi = button.data('vidremi'); 
		  $('#view_id_remitenteC').text(vidremi);
		  var vcargorem = button.data('vcargorem'); 
		  $('#view_cargoC').text(vcargorem);
		  var vnomrem = button.data('vnomrem'); 
		  $('#view_nombreC').text(vnomrem);
		  var viddest = button.data('viddest') ;
		  $('#view_enviadoporC').text(viddest);
		  var vcargodest = button.data('vcargodest'); 
		  $('#view_cargodestC').text(vcargodest);			
		  var vasuntodoc = button.data('vasuntodoc'); 
		  $('#view_asuntoC').val(vasuntodoc);
		  var vanexodest = button.data('vanexodest'); 
		  $('#view_anexoC').text(vanexodest);
		  var vindidest = button.data('vindidest'); 
		  $('#view_indicaC').text(vindidest);
		  var viddirec = button.data('viddirec'); 
		  $('#view_areainternaC').text(viddirec);
		 var idirecciones = button.data('idirecciones');
		 	$('#keep-orderC').multiSelect('deselect_all');
		 $('#keep-orderC').val(idirecciones).multiSelect();
		  var vfturnado = button.data('vfturnado'); 
		  $('#view_f_turnadoC').text(vfturnado);
		  var vfreceparea = button.data('vfreceparea');
		  $('#view_f_recepAreaC').text(vfreceparea);
		  var vinstdir = button.data('vinstdir'); 
		  $('#view_instrucC').text(vinstdir);
		  var vobs = button.data('vobs'); 
		  $('#view_obsC').text(vobs);
		  var vstatus = button.data('vstatus'); 
		  $('#view_statusC').val(vstatus);
		  var vfcapt = button.data('vfcapt'); 
		  $('#view_f_CaptC').val(vfcapt);
		  var vid = button.data('vid'); 
		  $('#view_idC').val(vid);
			
	})



		
		
$( "#finalizar_correspondencia" ).submit(function( event ) {		
	
				var parametros = new FormData($("#finalizar_correspondencia")[0]);
	             $("#finalizar_correspondencia")[0].reset();
				$.ajax({
						type: "POST",
						data: parametros,						
						url: "../../ajax/Direcciones/finalizar_original.php", //modificar
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
							$("#resultados").html("Enviando...");
						},
						success: function(datos){
						$("#resultados").html(datos);																
						load(1);						
						$('#viewCorrespondenciaModal').modal('hide');
					  }
				});
			  event.preventDefault();
			});	


	

/*function Guardar_cambios() {
	$( "#view_correspondencia" ).submit(function( event ) {
	 var data = $(this).serialize(),
            url = '../../ajax/Particular/guardar_cambios.php';

        $.post(url, data, function(msg) {
            alert(msg);
        }, 'json');

        event.preventDefault();
  	});	
}
function Guardar_cambios(){
	var url = '../../ajax/Particular/guardar_cambios.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#view_correspondencia').serialize(),
		success: function(registro){
		alert("Guardado con exito");
		load(1);	
			return false;
			
		}
	});
	return false;
}*/


	