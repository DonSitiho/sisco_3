<?php 
require_once '../php/conexion2.php';

function getObj(){
  $mysqli = getConn();
  $idu = $_POST['idu'];
  $query = "SELECT * FROM `oficinas` WHERE id_departamento = $idu";
  $result = $mysqli->query($query);
  $obj = '<option value="0">Elige una opción</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $obj .= "<option value='$row[id]'>$row[nombre]</option>";
  }
  return $obj;
}

echo getObj();
