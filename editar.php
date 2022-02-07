<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
        
       

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
    <title>Editar</title>
</head>
<body>

        <!--TRAEMOS EL NOMBRE DEL USUARIOS CON LA SESION-->
    <h1 class="subtitu">AGREGAR</h1>
    <div class="container">
        <a href="ncb.php" class="btn btnn" <?php if (  $_SESSION['ROL'] == 2){ ?> style="display: none;" <?php   } ?>>BENEFICIARIO</a>
        <a href="cliente.php" class="btn btnn" >CLIENTE</a>
        <a href="register.php" class="btn btnn" <?php if (  $_SESSION['ROL'] == 2){ ?> style="display: none;" <?php   } ?> >USUARIO</a>
    </div>
    <h1 class="subtitu2">EDITAR</h1>
    <div class="container">
        <a href="editarncb.php" class="btn btnn" <?php if (  $_SESSION['ROL'] == 2){ ?> style="display: none;" <?php   } ?>>BENEFICIARIO</a>
        <a href="editarCliente.php" class="btn btnn" >CLIENTE</a>
        <a href="editarus.php" class="btn btnn" <?php if (  $_SESSION['ROL'] == 2){ ?> style="display: none;" <?php   } ?> >USUARIO</a>
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
?>