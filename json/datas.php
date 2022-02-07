<?php
        //incluimos aconexion para usar 
    include_once ("../includes/conexion.php");
    //consulta con joins para traer los nombres de las llaves foraneas
    $sql = "SELECT idm AS 'idm', monitoreo.idu AS 'idu' ,  CONCAT(usuarios.nombre,' ',usuarios.apellidos) AS 'Nombre' , accion AS 'accion',fecha_hora AS 'fecha_hora',maquina AS 'maquina' FROM monitoreo INNER JOIN usuarios ON usuarios.idu = monitoreo.idu ORDER BY idm";
    $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
    $data = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
        $data[] = $rows;
    }
    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
    echo json_encode($results);
	exit;
?>