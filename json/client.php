
<?php
    //incluimos aconexion para usar 
    include_once ("../includes/conexion.php");
    //consulta con joins para traer los nombres de las llaves foraneas
    $sql = "SELECT * FROM clientes ";    $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
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