<?php 
    echo 'valor:'.$idcorresp;                               
    $query2 = mysqli_query($conexion,"SELECT * FROM  documentos where documentos.id_datos_c1 = $idcorresp");
        $checa_arch=0;                                                        
            while($row = mysqli_fetch_array($query2)){
                $id_archivo=$row['id_documento'];
                $nombres_archivo=$row['nombre_documento'];
                $checa_arch++;                                 
?>
            <tr >
                <td ><?php echo $id_archivo;?></td>
                <td ><?php echo $nombres_archivo;?></td>
            </tr>
<?php
        }                                  
?>               