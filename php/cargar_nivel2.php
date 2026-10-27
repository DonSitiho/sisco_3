<?php 
require_once '../php/conexion2.php';

function getAreas(){
  $mysqli = getConn();
  $ide = $_POST['ide'];
  $query = "SELECT * FROM `subdirecciones_oic` WHERE id_direccion1 = $ide AND id_direccion1 <> 0";
  $result = $mysqli->query($query);
  $areas = '<option value="0">Elige una opción</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $areas .= "<option value='$row[id]'>$row[nombre]</option>";
  }
  return $areas;
}

echo getAreas();
