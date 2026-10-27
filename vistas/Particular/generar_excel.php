<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />
<!--This is what you should include-->
<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">

<?php


require_once ("../../conexion.php");

$query  = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
$query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query2'], ENT_QUOTES)));
$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query3'], ENT_QUOTES)));
$query3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query4'], ENT_QUOTES)));

$valoresCheck = $_REQUEST['valoresCheck'];



$q  = (string)$query;
$q1 = (string)$query1;

$sWhere = "";

$tables="datos_correspondencia as dc";
$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";					

if($query3 == 0) {

if ($query2=='0'){
    
    $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' ";	  
              
}else{
    
    $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_direcciones= '".$query2."'";		  
              
}
}else{

    if ($query2=='0'){
    
        $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_remitente =  ".$query3." ";	  
                  
    }else{
        
        $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_direcciones= '".$query2."' AND dc.id_remitente =  ".$query3." ";		  
      

}

}


$sWhere.= "order by dc.folio";

$query = $conexion -> query ("SELECT $campos FROM  (($tables INNER JOIN dependencias 
                            ON dependencias.id_dependencia=dc.id_remitente)
                            INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
                            INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
                            where $sWhere ");


                 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel.xls"');
header('Cache-Control: max-age=0');
header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );



?>



<table border = 1>
   
    <tr>
        <?php
        foreach($valoresCheck as $value){
            echo '<th>'.$value.'</th>';
        }
       // exit();
          ?>
     
    </tr>

    <?php
       // $num_corres=1;
        echo '  <tr>';
        while ($row = mysqli_fetch_array($query)) {			
            
            foreach($valoresCheck as $value){
                if($value == 'id_remitente')
                {
                    $value ='nombre';
                }
                elseif($value == 'id_destinatarios')
                {
                    $value ='nombre';
                }
                elseif($value == 'id_direcciones')
                {
                    $value ='nombre_direccion';
                }
                echo '<td>'.$row[$value].'</td>';
            }	
            echo '</tr> ';
        } 		
    ?>						
  
        
   

</table>
