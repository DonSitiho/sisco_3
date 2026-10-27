$(document).ready(function(){
  $.ajax({
    type: 'POST',
    url: '../../php/cargar_nivel1.php'
  })
  .done(function(lista_rep){
    //alert(lista_rep);
    $('#id_nivel1').html(lista_rep)
  })
  .fail(function(){
    alert('Hubo un errror al cargar la lista de áreas')
  })

  $('#id_nivel1').on('change', function(){
    var ide = $('#id_nivel1').val()
    $.ajax({
      type: 'POST',
      url: '../../php/cargar_nivel2.php',
      data: {'ide': ide}
    })
    .done(function(listas_rep){
      $('#id_nivel2').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un errror al cargar la lista de áreas nivel2')
    })
  })

  $('#id_nivel2').on('change', function(){
    var ida = $('#id_nivel2').val()
    $.ajax({
      type: 'POST',
      url: '../../php/cargar_nivel3.php',
      data: {'ida': ida}
    })
    .done(function(listas_rep){
      $('#id_nivel3').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un errror al cargar la lista de áreas nivel3')
    })
  })

  $('#id_nivel3').on('change', function(){
    var idu = $('#id_nivel3').val()
    $.ajax({
      type: 'POST',
      url: '../../php/cargar_nivel4.php',
      data: {'idu': idu}
    })
    .done(function(listas_rep){
      $('#id_nivel4').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un errror al cargar la lista de áreas nivel4')
    })
  })

  $('#enviar').on('click', function(){
    var resultado = 'Lista de reproducción: ' + $('#idEje option:selected').text() +
    ' Video elegido: ' + $('#videos option:selected').text()

    $('#resultado1').html(resultado)
  })

})