		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var query1=$("#q1").val();
			var query2=$("#q2").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'query1':query1,'query2':query2,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../modelos/listar_oficiosrio.php',
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
				url:'../modelos/listar_oficiosgen.php',
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

		
		$('#editOficiosrioModal').on('show.bs.modal', function (event) {
		  	var button = $(event.relatedTarget) // Button that triggered the modal
			var efsolicitado = button.data('efsolicitado') 
			$('#edit_fsolicitado').val(efsolicitado)
			var efoficio = button.data('efoficio') 
			$('#edit_foficio').val(efoficio)
			var enomofi = button.data('enomofi') 
		  	$('#edit_nomofi').val(enomofi)
		  	var ecargofi = button.data('ecargofi') 
			$('#edit_cargofi').val(ecargofi)			 		  				
			var eiddep = button.data('eiddep') 
			$('#edit_iddep').val(eiddep).trigger('change')
			var easunto = button.data('easunto') 
			$('#edit_asunto').val(easunto)
		  	var esolicitante = button.data('esolicitante') 
		  	$('#edit_solicitante').val(esolicitante)
			var eidarea = button.data('eidarea') 
			$('#edit_idarea').val(eidarea).trigger('change')
			var efoliorel = button.data('efoliorel') 
			$('#edit_foliorel').val(efoliorel)			
			var estatus = button.data('estatus') 
			$('#edit_status').val(estatus)			
			var efolio = button.data('efolio') 
			$('#edit_folio').val(efolio)
		  	var eid = button.data('eid') 
		  	$('#edit_id').val(eid)
		})

		$('#revisaOficiosrioModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var rnumofi = button.data('rnumofi') 
		  $('#revisa_nofi').val(rnumofi)
		  var rfsolicitado = button.data('rfsolicitado') 
		  $('#revisa_fsolicitado').val(rfsolicitado)
		  var rfoficio = button.data('rfoficio') 
		  $('#revisa_foficio').val(rfoficio)
		  var rnomofi = button.data('rnomofi') 
		  $('#revisa_nomofi').val(rnomofi)
		  var rcargofi = button.data('rcargofi') 
		  $('#revisa_cargofi').val(rcargofi)			 		  					
		  var riddep = button.data('riddep') 
		  $('#revisa_iddep').val(riddep).trigger('change')
		  var rasunto = button.data('rasunto')		  
		  $('#revisa_asunto').val(rasunto)
		  var rsolicitante = button.data('rsolicitante') 
		  $('#revisa_solicitante').val(rsolicitante)
		  var ridarea = button.data('ridarea') 
		  $('#revisa_idarea').val(ridarea).trigger('change')
		  var rfoliorel = button.data('rfoliorel') 
		  $('#revisa_foliorel').val(rfoliorel)			
		  var rstatus = button.data('rstatus') 
		  $('#revisa_status').val(rstatus)
		  var rfingreso = button.data('rfingreso') 
		  $('#revisa_fingreso').val(rfingreso)
		  var rfentrega = button.data('rfentrega') 
		  $('#revisa_fentrega').val(rfentrega)
		  var rnomrecibe = button.data('rnomrecibe') 
		  $('#revisa_nomrecibe').val(rnomrecibe)
		  var rfolio = button.data('rfolio') 
		  $('#revisa_rfolio').val(rfolio)
		  var rid = button.data('rid') 
		  $('#revisa_id').val(rid)
	  })
		  
	  $('#vinculaOficiosrioModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal						
		var vinid = button.data('vinid') 
		$('#vincula_id_ofi').val(vinid)
	  })

	  
		$('#viewOficiosrioModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var vfsolicitado = button.data('vfsolicitado') 
		  $('#view_fsolicitado').val(vfsolicitado)
		  var vfoficio = button.data('vfoficio') 
		  $('#view_foficio').val(vfoficio)
		  var vnomofi = button.data('vnomofi') 
		  $('#view_nomofi').val(vnomofi)
		  var vcargofi = button.data('vcargofi') 
		  $('#view_cargofi').val(vcargofi)			 		  					
		  var viddep = button.data('viddep') 
		  $('#view_iddep').val(viddep).trigger('change')
		  var vasunto = button.data('vasunto') 
		  $('#view_asuntodoc').val(vasunto)
		  var vsolicitante = button.data('vsolicitante') 
		  $('#view_solicitante').val(vsolicitante)
		  var vidarea = button.data('vidarea') 
		  $('#view_idarea').val(vidarea).trigger('change')
		  var vfoliorel = button.data('vfoliorel') 
		  $('#view_foliorel').val(vfoliorel)			
		  var vstatus = button.data('vstatus') 
		  $('#view_status').val(vstatus)			
		  var vfolio = button.data('vfolio') 
		  $('#view_folio').val(vfolio)			
		  var vid= button.data('vid') 
		  $('#view_id').val(vid)
	  })

	  $('#viewOficiosrevModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var vrnumofi = button.data('vrnumofi') 
		$('#view_vrnofi').val(vrnumofi)
		var vrfsolicitado = button.data('vrfsolicitado') 
		$('#view_vrfsolicitado').val(vrfsolicitado)
		var vrfoficio = button.data('vrfoficio') 
		$('#view_vrfoficio').val(vrfoficio)
		var vrnomofi = button.data('vrnomofi') 
		$('#view_vrnomofi').val(vrnomofi)
		var vrcargofi = button.data('vrcargofi') 
		$('#view_vrcargofi').val(vrcargofi)			 		  					
		var vriddep = button.data('vriddep') 
		$('#view_vriddep').val(vriddep).trigger('change')
		var vrasunto = button.data('vrasunto') 
		$('#view_vrasuntoc').val(vrasunto)
		var vrsolicitante = button.data('vrsolicitante') 
		$('#view_vrsolicitante').val(vrsolicitante)
		var vridarea = button.data('vridarea') 
		$('#view_vridarea').val(vridarea).trigger('change')
		var vrfoliorel = button.data('vrfoliorel') 
		$('#view_vrfoliorel').val(vrfoliorel)			
		var vrstatus = button.data('vrstatus') 
		$('#view_vrstatus').val(vrstatus)
		var vrfingreso = button.data('vrfingreso') 
		$('#view_vrfingreso').val(vrfingreso)
		var vrfentrega = button.data('vrfentrega') 
		$('#view_vrfentrega').val(vrfentrega)
		var vrnomrecibe = button.data('vrnomrecibe') 
		$('#view_vrnomrecibe').val(vrnomrecibe)	
		var vrfolio = button.data('vrfolio') 
		$('#view_vrfolio').val(vrfolio)			
		var vrid= button.data('vrid') 
		$('#view_vrid').val(vrid)
	})


		$('#deleteOficiosrioModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})

		
		$('#reasignaOficiosrioModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#reasigna_id').val(id)
		})

		$('#copiarOficiosrioModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#id_copy').val(id)
		})

		$('#reservarOficiosrioModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#id_reserva').val(id)
		})

		$('#eliminarArchivoModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#eliminar_id').val(id)
		})
		
		$('#loadOficiosModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#id_oficio').val(id)
		})
		
			
		$( "#edit_oficiosrio" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../modelos/editar_oficiosrio.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);					
					$('#edit_oficiosrio').trigger("reset");
					$('#editOficiosrioModal').modal('hide');
					load(parseInt(document.getElementById("numpagofi").value));
				  }
			});
		  event.preventDefault();
		});
		
		$( "#revisa_oficiosrio" ).submit(function( event ) {
			var parametros = $(this).serialize();
			  $.ajax({
					  type: "POST",
					  url: "../modelos/revisar_oficiosrio.php",
					  data: parametros,
					   beforeSend: function(objeto){
						  $("#resultados").html("Enviando...");
						},
					  success: function(datos){
					  $("#resultados").html(datos);					  
					  $('#revisa_oficiosrio').trigger("reset");
					  $('#revisaOficiosrioModal').modal('hide');
					  load(parseInt(document.getElementById("numpagofi").value));
					}
			  });
			event.preventDefault();
		  });
		
		$( "#add_oficiosrio" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "../modelos/guardar_oficiosrio.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					$('#add_oficiosrio').trigger("reset");
					$("#area_interna").select2("val", " ");
					$("#idDestino").select2("val", " ");					
					$('#addOficiosrioModal').modal('hide');
					load(1);
				  }
			});
		  event.preventDefault();
		});

		$( "#copy_oficio" ).submit(function( event ) {
			var parametros = $(this).serialize();
			  $.ajax({
					  type: "POST",
					  url: "../modelos/copiar_oficio.php",
					  data: parametros,
					   beforeSend: function(objeto){
						  $("#resultados").html("Enviando...");
						},
					  success: function(datos){
					  $("#resultados").html(datos);
					  load(1);
					  $('#copiarOficiosrioModal').modal('hide');
					}
			  });
			event.preventDefault();
		  });

		  $( "#reserva_oficio" ).submit(function( event ) {
			var parametros = $(this).serialize();
			  $.ajax({
					  type: "POST",
					  url: "../modelos/reservar_oficio.php",
					  data: parametros,
					   beforeSend: function(objeto){
						  $("#resultados").html("Enviando...");
						},
					  success: function(datos){
					  $("#resultados").html(datos);
					  load(1);
					  $('#reservarOficiosrioModal').modal('hide');
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
		
		  
		  
		  $( "#delete_oficiosrio" ).submit(function( event ) {
			  var parametros = $(this).serialize();
			  $.ajax({
				  type: "POST",
				  url: "../modelos/cancelar_oficio.php",
				  data: parametros,
				  beforeSend: function(objeto){
					  $("#resultados").html("Enviando...");
					},
					success: function(datos){
						$("#resultados").html(datos);
						load(1);
						$('#deleteOficiosrioModal').modal('hide');
					}
				});
				event.preventDefault();
			});

			$( "#reasignar_oficiosrio" ).submit(function( event ) {
				var parametros = $(this).serialize();
				$.ajax({
					type: "POST",
					url: "../modelos/reasignar_oficio.php",
					data: parametros,
					beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					  success: function(datos){
						  $("#resultados").html(datos);
						  load(1);
						  $('#reasignaOficiosrioModal').modal('hide');
						  load(parseInt(document.getElementById("numpag").value));
					  }
				  });
				  event.preventDefault();
			  });
			  
			
			$( "#cancelar_oficio" ).submit(function( event ) {
				var parametros = $(this).serialize();
				$.ajax({
					type: "POST",
					url: "../modelos/cancelar_oficio.php",
					data: parametros,
					beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					  success: function(datos){
						  $("#resultados").html(datos);
						  load(1);
						  $('#viewCorrespondenciaModal').modal('hide');
						  $('#eliminarArchivoModal').modal('hide');
						  load(parseInt(document.getElementById("numpag").value));
					  }
				  });
				  event.preventDefault();
			  });

			
			
			
			$( "#vincula_oficiosrio" ).submit(function( event ) {				
				var parametros = new FormData($("#vincula_oficiosrio")[0]);
				$.ajax({
						type: "POST",
						data: parametros,						
						url: "../modelos/subir_respuesta.php",
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
							$("#resultados").html("Enviando...");
						},
						success: function(datos){
						$("#resultados").html(datos);																
						buscaofi(1);	
						$('#vincula_oficiosrio').trigger("reset");					
						$('#vinculaOficiosrioModal').modal('hide');
					  }
				});
			  event.preventDefault();
			});	
			

			$( "#load_oficios" ).submit(function( event ) {				
				var parametros = new FormData($("#load_oficios")[0]);
				
				$.ajax({
						type: "POST",
						data: parametros,						
						url: "../modelos/subir_oficios.php",
						contentType: false,
						processData: false,
						beforeSend: function(objeto){
							$("#resultados").html("Enviando...");
						},
						success: function(datos){
						$("#resultados").html(datos);																
						$('#loadOficiosModal').modal('hide');
						load(parseInt(document.getElementById("numpagofi").value));						
					  }
				});
			  event.preventDefault();
			});		




			function mostrararchivostres(id) {
	
				$.ajax({
					url: '../modelos/docs-list.php',
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
								<a target=\"_blank\" href="${doc.ruta}" class="dep"><i class="material-icons" data-toggle="tooltip" title="Ver archivos">&#xe8f4;</i></a>
								</td>					
								
								</tr>
							  `
					  });
					  $('#tasks3').html(template);
					}
				  });
			}

