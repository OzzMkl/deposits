<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {

        if ($_SESSION['iduser'] != '11')
        {
            header("location:index.php");
        }
        else{

    include "includes/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>   
      <!--css de la tabla-->
      <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/buscar.css">
    <link rel="stylesheet" href="css/dataTables.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Depósitos</title>
</head>
<body>
<div class="container">
        <a href="mpolizas.php" class="btn btnn">REGRESAR</a>
    <div><!---INPUTS DE BUSQUEDA-->
        <label for="min">FECHA INICIO: </label> <input id="min" name="min" type="text" placeholder="AÑO-MES-DIA" />
        <label for="max">FECHA FINAL: </label><input id="max" name="max" type="text" placeholder="AÑO-MES-DIA" />
    </div>
</div>
    <!--TABLA****************************************************** -->
<div class="row">
		 <!--ES IMPORTANTE DECLARAR EL ID DE LA TABLA YA QUE ESTE SE TOMA EN EL ARCHIVO date.js-->
		<table id="rpoliza" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>BENEFICIARIO</th>
                <th>TIPO DE TRANSACCION</th>
                <th>MONTO</th>
                <th>REFERENCIA NUMERICA</th>
                <th>FECHA DE OPERACION</th>
                <th>PROVEEDOR</th>
                <th>USUARIO</th>
                <th>MOTIVO</th>
                <th>FECHA DE INGRESO</th>
            </tr>
        </thead>
 
        
    </table>		
	</div>
    <!-- FIN TABLA****************************************************** -->
    <!--script para datatable.js-->
  
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.rpoliza.js"></script>
    
    <script type="text/javascript" charset="utf8" src="js/rpolizas.js"></script>


  <!--botones datablesjs scripts-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</script>
</body>

</html>

<?php
        }
    }
?>