<?php


  include('conexion.php');

  $idcorr= $_REQUEST['id'];

  $query = "SELECT * from documentos where documentos.id_datos_c1 = $idcorr";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die('La Conexión fallo'. mysqli_error($conexion));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'iddoc' => $row['id_documento'],
      'nombre' => $row['nombre_documento'],
      'ruta' => $row['ruta'],
      'idcorres' => $row['id_datos_c1']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;


?>