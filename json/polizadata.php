
<?php
    //incluimos aconexion para usar 
    include_once ("../includes/conexion.php");
    //consulta con joins para traer los nombres de las llaves foraneas
    $sql = "SELECT idPoliza AS 'ID', ncb.banco AS 'Cuenta', transaccion.tipo AS 'Transaccion', monto AS 'Monto', ref_num AS 'Referencia_Numerica', fecha_envio AS 'Fecha', proveedor AS 'Proveedor', CONCAT(usuarios.nombre,' ',usuarios.apellidos) AS 'Usuario', motivo AS 'Motivo', fecha_ingreso AS 'Fecha_de_Ingreso_al_Sistema' FROM poliza INNER JOIN ncb ON poliza.ncb_id = ncb.idn INNER JOIN transaccion ON poliza.tipo_id = transaccion.idt INNER JOIN usuarios ON poliza.usuario_id = usuarios.idu ORDER BY idPoliza";    $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
    $data = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
        $data[] = $rows;//se recorre la consulta y se asigna a data
    }
    //esto ya es de datatables.js
    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
    echo json_encode($results);
	exit;
?>