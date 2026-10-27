<?php 
require_once '../php/conexion2.php';

function getListasEjes(){
  $mysqli = getConn();
  $query = 'SELECT * FROM direcciones_secoem where id_direccion <> 0 AND id_direccion <> 9999 AND id_direccion <> 8888 ';
  $result = $mysqli->query($query);
  $lista = '<option value="0">Elige una opción</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $lista .= "<option value='$row[id_direccion]'>$row[nombre_direccion]</option>";
  }
  return $lista;
}

echo getListasEjes();