
<?php
    //incluimos aconexion para usar 
    include_once ("../includes/conexion.php");
    //consulta con joins para traer los nombres de las llaves foraneas
    $sql = "SELECT idDeposito AS 'ID',
     ncb.banco AS 'Cuenta',
      transaccion.tipo AS 'Transaccion',
       monto AS 'Monto',
        clave_rastreo AS 'Clave_de_Rastreo',
         ref_num AS 'Referencia_Numerica',
          fecha_envio AS 'Fecha',
           CONCAT(clientes.nombre,' ',clientes.apellidos) AS 'Cliente',
            bancos.banco AS 'Banco_Emisor',
             factura AS 'Factura',
              folio_remision AS 'Folio_de_Remision',
               sucursal.nombre AS 'Sucursal',
                CONCAT(usuarios.nombre,' ',usuarios.apellidos) AS 'Usuario',
                 estado.nombre AS 'Status',
                  cambios AS 'Cambios',
                  eC.nombre AS 'StatusC',
                  cambiosC AS 'CambiosC',
                   fecha_ingreso AS 'Fecha_de_Ingreso_al_Sistema' FROM deposito 
                   INNER JOIN ncb ON deposito.ncb_id = ncb.idn 
                   INNER JOIN transaccion ON deposito.tipo_id = transaccion.idt 
                   INNER JOIN bancos ON deposito.banco_emisor_id = bancos.idb 
                   INNER JOIN usuarios ON deposito.usuario_id = usuarios.idu 
                   INNER JOIN sucursal ON deposito.sucursal = sucursal.nombre 
                   INNER JOIN estado ON deposito.statuss = estado.ide 
                   INNER JOIN estado AS eC ON deposito.statusC = eC.ide 
                   INNER JOIN clientes ON deposito.idc = clientes.idc 
                   WHERE statuss!=2 ORDER BY `ID` DESC";    $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
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