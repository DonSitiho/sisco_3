
<?php 
if(isset($_GET['id'])){

	require_once('../conexion.php');
	// Update al registro
	$id = $_GET['id'];
	//
	$modificar = mysqli_query($conexion, "UPDATE oficios_conocimiento SET is_active = 0 WHERE id = $id");

    
	
}else{
	//header("Location: ../../index.php");
}
?>
