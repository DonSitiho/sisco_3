<?php 
require('conexion.php');
sleep(1);
if (isset($_POST)) {

    $usarfolio = (string)$_POST['usarfolio'];
    
    $result = $conexion->query(

        "SELECT * FROM `datos_correspondencia` WHERE `folio` LIKE '%$usarfolio%';"
    );
    
    if ($result->num_rows > 0) {

        echo '<div class="alert alert-danger"><strong>Oh no!</strong> Folio no disponible.</div>';

    } else {

        echo '<div class="alert alert-success"><strong>Enhorabuena!</strong> Folio disponible.</div>';
        
    }
}