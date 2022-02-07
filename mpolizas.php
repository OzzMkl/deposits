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
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <title>POLIZAS</title>
</head>
<body>

        <!--MENU DE POLIZAS-->
    <h1 class="subtitu">POLIZAS</h1>
    <div class="container">
        <a href="polizas.php" class="btn btnn" >AGREGAR</a>
        <a href="editarPoliza" class="btn btnn" >EDITAR</a>
        <a href="rpolizas.php" class="btn btnn" >REPORTE</a>
    </div>
    <div class="container">
        <a href="index.php" class="btn btnn">REGRESAR</a>
    </div>
    </body>
    <footer>
    </footer>
</html>
<?php
        }
    }
?>