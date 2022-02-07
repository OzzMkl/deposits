<?php
        //incluimos aconexion para usar 
    include_once ("../includes/conexion.php");
    //consulta con joins para traer los nombres de las llaves foraneas
    $sql = "SELECT DISTINCT accion AS 'Accion',SUBSTRING(accion,42, 4) AS 'idDeposito', CONCAT(usuarios.nombre,' ',usuarios.apellidos) AS 'Usuario', fecha_hora as 'Fecha' FROM monitoreo INNER JOIN usuarios ON monitoreo.idu = usuarios.idu  WHERE usuarios.rol_id = 3 AND accion LIKE '%STATUS: RECIBIDO%'
    UNION SELECT DISTINCT accion AS 'Accion',SUBSTRING(accion,43, 4) AS 'idDeposito', CONCAT(usuarios.nombre,' ',usuarios.apellidos) AS 'Usuario', fecha_hora as 'Fecha' FROM monitoreo INNER JOIN usuarios ON monitoreo.idu = usuarios.idu  WHERE usuarios.rol_id = 3 AND accion LIKE '%STATUSC:%'";
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