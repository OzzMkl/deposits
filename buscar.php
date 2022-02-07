<?php 
/**incluimos datos de conexion a la base de datos */
    include ("includes/conexion.php"); 
    /**SE MANTIENE LA SESION */
    session_start();
    /**SI NO EXISTE */
    if(!isset($_SESSION["session_username"])) {
        /**LO MANDAMOS A LOGIN */
        header("location:login.php");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>   
<link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/buscar.css">
    <link rel="stylesheet" href="css/dataTables.css">
      <!--css de la tabla-->
      
      <!---->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Buscar Deposito</title>
</head>
<body>
<div class="container">
<a href="index.php" class="btn btnn">REGRESAR</a>
<div><!---INPUTS DE BUSQUEDA-->
    <h2 style="color:#fff;">CUADROS DE BUSQUEDA</h2>
        <label for="min">FECHA INICIO: </label> <input id="min" name="min" type="text" placeholder="AÑO-MES-DIA" />
        <label for="max">FECHA FINAL: </label><input id="max" name="max" type="text" placeholder="AÑO-MES-DIA" />
    </div>
    
</div>
    <div style="text-align:right;">
        <label for="cliente">CLIENTE: </label><input id="cliente" name="cliente" type="text" placeholder="nombre" />
        <label for="column3_search">MONTO: </label><input id="column3_search" name="column3_search" type="text" placeholder="$$$" />
    </div>
    <br>


    <!--TABLA****************************************************** -->
<div class="row">
		 <!--ES IMPORTANTE DECLARAR EL ID DE LA TABLA YA QUE ESTE SE TOMA EN EL ARCHIVO date.js-->
		<table id="example" class="display" width="80%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Cuenta</th>
                <th>TIPO</th>
                <th>MONTO</th>
                <th>CLAVE DE RASTREO</th>
                <th>REFERENCIA NUMERICA</th>
                <th>FECHA DE OPERACION</th>
                <th>CLIENTE</th>
                <th>BANCO EMISOR</th>
                <th>FACTURA</th>
                <th>FOLIO REMISION</th>
                <th>SUCURSAL</th>
                <th>USUARIO</th>
                <th>ESTADO</th>
                <th>CAMBIOS AUTORIZADOS POR:</th>
                <th>CAJAS</th>
                <th>USUARIO CAJAS:</th>
                <th>FECHA DE INGRESO</th>
            </tr>
        </thead>
 
        
    </table>		
	</div>
    <!-- FIN TABLA****************************************************** -->
    <!--script para datatable.js-->
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="js/date.js"></script>
</body>
</html>
<?php
}
?>