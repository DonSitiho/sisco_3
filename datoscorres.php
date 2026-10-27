<?php
    
    $datoscorres = array();

    $mysqli = new mysqli("localhost","root","","correspondencia_secoem");
    $mysqli->set_charset('utf8');

	$tables="datos_correspondencia as dc";
	$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";	
	$sWhere=" order by dc.id_datos_c";
	
    $statement = $mysqli->prepare ("SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
                                                                 INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
                                                                 INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
                                                                 where $sWhere"); 
	
	
    $statement -> execute();
    $resultado = $statement -> get_result();

    while($row = $resultado->fetch_assoc()) $datoscorres[] = $row;
    
    $mysqli->close();

    
?>


