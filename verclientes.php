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
    <link rel="stylesheet" href="css/buscar.css">
    <link rel="stylesheet" href="css/dataTables.css">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
      <!--css de la tabla-->
      
      <!---->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Ver Clientes</title>
</head>
<body>
<div class="container">
<a href="index.php" class="btn btnn">REGRESAR</a>
</div>
    <!--TABLA****************************************************** -->
<div class="row">
		 <!--ES IMPORTANTE DECLARAR EL ID DE LA TABLA YA QUE ESTE SE TOMA EN EL ARCHIVO date.js-->
		<table id="cliente" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>TERMINACION DE TARJETA</th>
            </tr>
        </thead>
    </table>		
	</div>
    <!-- FIN TABLA****************************************************** -->
    <!--script para datatable.js-->
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/script.js"></script>
</body>
</html>
<?php
}
?>