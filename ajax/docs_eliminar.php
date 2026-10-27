<?php

include('conexion.php');

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $query = "DELETE FROM documentos WHERE id_documento = $id"; 
  $result = mysqli_query($conexion, $query);

  if (!$result) {
    die('Consulta fallida!.');
  }
  echo "Archivo eliminado correctamente";  

}

?>
