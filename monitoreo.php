<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
        
        if ($_SESSION["ROL"] == 1 || $_SESSION['ROL'] == 3){

    include "includes/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/buscar.css">
    <link rel="stylesheet" href="css/dataTables.css">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <title>Monitoreo</title>
</head>
<body>
<div class="container">
        <a href="index.php" class="btn btnn">REGRESAR</a>
    <div><!---INPUTS DE BUSQUEDA-->
        <label for="min">fecha inicio: </label> <input id="min" name="min" type="text" placeholder="Search by Date" />
        <label for="max">fecha final: </label><input id="max" name="max" type="text" placeholder="Search by Date" />
    </div>
</div>
   <!--TABLA****************************************************** -->
   <div class="row">
		
		<table id="MONITOREO" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Monitoreo</th>
                <th>ID Usuario</th>
                <th>Nombre Usuario</th>
                <th>Accion</th>
                <th>Fecha</th>
                <th>Maquina</th>
            </tr>
        </thead> 
    </table>		
	</div>
    <!--TABLA****************************************************** -->
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.monitoreo.js"></script>
<script type="text/javascript" src="js/monitoreo.js"></script>
<!--botones datablesjs scripts-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    </body>
    <footer>
    </footer>
</html>
<?php
      }
        else{
    header("location:index.php");
}
    }
?>