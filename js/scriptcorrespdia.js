		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_correspondenciadia.php',
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

		
		
		$('#editCorrespondenciaModal').on('show.bs.modal', function (event) {
		  	var button = $(event.relatedTarget) // Button that triggered the modal
			var folio = button.data('folio') 
			$('#edit_folio').val(folio)
			var frecep = button.data('frecep') 
			$('#edit_f_recepcion').val(frecep)
			var nofi = button.data('nofi') 
		  	$('#edit_num_oficio').val(nofi)
		  	var fofi = button.data('fofi') 
		  	$('#edit_f_oficio').val(fofi)		  
			var tofi = button.data('tofi') 
			$('#edit_t_oficio').val(tofi)
			var idremi = button.data('idremi') 
			$('#edit_id_remitente').val(idremi).trigger('change')
			var cargorem = button.data('cargorem') 
			$('#edit_cargo').val(cargorem)
		  	var nomrem = button.data('nomrem') 
		  	$('#edit_nombre').val(nomrem)
			var iddest = button.data('iddest')
			$('#edit_enviadopor').val(iddest).trigger('change')
			var cargodest = button.data('cargodest') 
			$('#edit_cargodest').val(cargodest)			
			var asuntodoc = button.data('asuntodoc') 
			$('#edit_asunto').val(asuntodoc)
			var anexodest = button.data('anexodest') 
			$('#edit_anexo').val(anexodest)
			var indidest = button.data('indidest') 
			$('#edit_indica').val(indidest)
			var iddirec = button.data('iddirec') 
			$('#edit_areainterna').val(iddirec).trigger('change')	
			var fturnado = button.data('fturnado') 
			$('#edit_f_turnado').val(fturnado)
			var freceparea = button.data('freceparea')
			$('#edit_f_recepArea').val(freceparea)
			var instdir = button.data('instdir') 
			$('#edit_instruc').val(instdir)
			var obs = button.data('obs') 
			$('#edit_obs').val(obs)
			var status = button.data('status') 
			$('#edit_status').val(status)
			var fcapt = button.data('fcapt') 
			$('#edit_f_Capt').val(fcapt)
		  	var id = button.data('id') 
		  	$('#edit_id').val(id)
		})

		$('#viewCorrespondenciaModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var vfolio = button.data('vfolio') 
		  $('#view_folio').val(vfolio)
		  var vfrecep = button.data('vfrecep')  
		  $('#view_f_recepcion').val(vfrecep)
		  var vnofi = button.data('vnofi') 
		  $('#view_num_oficio').val(vnofi)
		  var vfofi = button.data('vfofi') 
		  $('#view_f_oficio').val(vfofi)
		  var vtofi = button.data('nofi'); 
		  $('#view_t0_oficio').prop('checked', true)
		  var vidremi = button.data('vidremi') 
		  $('#view_id_remitente').val(vidremi)
		  var vcargorem = button.data('vcargorem') 
		  $('#view_cargo').val(vcargorem)
		  var vnomrem = button.data('vnomrem') 
		  $('#view_nombre').val(vnomrem)
		  var viddest = button.data('viddest') 
		  $('#view_enviadopor').val(viddest)
		  var vcargodest = button.data('vcargodest') 
		  $('#view_cargodest').val(vcargodest)			
		  var vasuntodoc = button.data('vasuntodoc') 
		  $('#view_asunto').val(vasuntodoc)
		  var vanexodest = button.data('vanexodest') 
		  $('#view_anexo').val(vanexodest)
		  var vindidest = button.data('vindidest') 
		  $('#view_indica').val(vindidest)
		  var viddirec = button.data('viddirec') 
		  $('#view_areainterna').val(viddirec)	
		  var vfturnado = button.data('vfturnado') 
		  $('#view_f_turnado').val(vfturnado)
		  var vfreceparea = button.data('vfreceparea')
		  $('#view_f_recepArea').val(vfreceparea)
		  var vinstdir = button.data('vinstdir') 
		  $('#view_instruc').val(vinstdir)
		  var vobs = button.data('vobs') 
		  $('#view_obs').val(vobs)
		  var vstatus = button.data('vstatus') 
		  $('#view_status').val(vstatus)
		  var vfcapt = button.data('vfcapt') 
		  $('#view_f_Capt').val(vfcapt)
		  var vid = button.data('vid') 
		  $('#view_id').val(vid)
	  })

		$('#deleteCorrespondenciaModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})

		$('#eliminarArchivoModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#eliminar_id').val(id)
		})
		
		$('#loadCorrespondenciaModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#id_correspondencia').val(id)
		})
		
			
		$( "#edit_correspondencia" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_corresp.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);					
					$('#edit_correspondencia').trigger("reset");
					$('#editCorrespondenciaModal').modal('hide');
					load(parseInt(document.getElementById("numpagdia").value));
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_corresp" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_corresp.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#add_corresp').trigger("reset");
					$("#id_remitente").select2("val", " ");
					$("#enviadopor").select2("val", " ");
					$("#areainterna").select2("val", " ");
					$('#addCorrespondenciaModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});

		$( "#copy_corresp" ).submit(function( event ) {
			var parametros = $(this).serialize();
			  $.ajax({
					  type: "POST",
					  url: "ajax/copiar_corresp.php",
					  data: parametros,
					   beforeSend: function(objeto){
						  $("#resultados").html("Enviando...");
						},
					  success: function(datos){
					  $("#resultados").html(datos);
					  load(1);
					  $('#mdl_copiar').modal('hide');
					}
			  });
			event.preventDefault();
		  });

		  $( "#duplica_corresp" ).submit(function( event ) {
			var parametros = $(this).serialize();
			  $.ajax({
					  type: "POST",
					  url: "ajax/duplicar_corresp.php",
					  data: parametros,
					   beforeSend: function(objeto){
						  $("#resultados").html("Enviando...");
						},
					  success: function(datos){
					  $("#resultados").html(datos);
					  load(1);
					  $('#mdl_duplicar').modal('hide');
					}
			  });
			event.preventDefault();
		  });
		
		  
		  
		  $( "#delete_corresp" ).submit(function( event ) {
			  var parametros = $(this).serialize();
			  $.ajax({
				  type: "POST",
				  url: "ajax/eliminar_corresp.php",
				  data: parametros,
				  beforeSend: function(objeto){
					  $("#resultados").html("Enviando...");
					},
					success: function(datos){
						$("#resultados").html(datos);
						load(1);
						$('#deleteCorrespondenciaModal').modal('hide');
					}
				});
				event.preventDefault();
			});
			
			$( "#delete_archivo" ).submit(function( event ) {
				var parametros = $(this).serialize();
				$.ajax({
					type: "POST",
					url: "ajax/eliminar_archivo.php",
					data: parametros,
					beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					  success: function(datos){
						  $("#resultados").html(datos);
						  load(1);
						  $('#viewCorrespondenciaModal').modal('hide');
						  $('#eliminarArchivoModal').modal('hide');
					  }
				  });
				  event.preventDefault();
			  });

			
			$( "#load_corresp" ).submit(function( event ) {				
				var parametros = new FormData($("#load_corresp")[0]);
				$.ajax({
						type: "POST",
						data: parametros,						
						url: "ajax/subir_corresp.php",
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
							$("#resultados").html("Enviando...");
						},
						success: function(datos){
						$("#resultados").html(datos);																												
						$('#loadCorrespondenciaModal').modal('hide');
						load(parseInt(document.getElementById("numpagdia").value));
					  }
				});
			  event.preventDefault();
			});		
			

function mostrararchivos(id) {
	
	$.ajax({
		url: 'ajax/docs-list.php',
		data: {id},
		type: 'POST',
		success: function(response) {
		  const docs = JSON.parse(response);
		  let template = '';
		  docs.forEach(doc => {
			template += `
					<tr docskId="${doc.iddoc}">
					
					<td>
					<a href="#" class="doc-item">
					  ${doc.nombre} 
					</a>
					</td>
						
					<td>
					<a target=\"_blank\" href="Correspondencia/${doc.ruta}" class="dep"><i class="material-icons" data-toggle="tooltip" title="Ver archivos">&#xe8f4;</i></a>
					</td>					
					<td>
					<a href="#eliminarArchivoModal" class="delete task-delete" data-toggle="modal" data-id="${doc.iddoc}"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
					</td>
					</tr>
				  `
		  });
		  $('#tasks').html(template);
		}
	  });
}

