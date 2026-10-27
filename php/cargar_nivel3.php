<?php 
require_once '../php/conexion2.php';

function getObj(){
  $mysqli = getConn();
  $ida = $_POST['ida'];
  $query = "SELECT * FROM `departamentos` WHERE id_sub_oic = $ida";
  $result = $mysqli->query($query);
  $obj = '<option value="0">Elige una opción</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $obj .= "<option value='$row[id]'>$row[nombre_depto]</option>";
  }
  return $obj;
}

echo getObj();
