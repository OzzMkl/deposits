<?php 
    //mantenemos la asesion
    session_start();
    if(!isset($_SESSION["session_username"])) {
        //si no existe lo mandamos a iniciar
        header("location:login.php");
    } else {
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sweetalert.css">
    <title>Principal</title>
</head>
<body>

        <!--TRAEMOS EL NOMBRE DEL USUARIOS CON LA SESION-->
    <h1 class="titu">Bienvenido, <span><?php echo $_SESSION['session_username'];?> </span> </h1>
    <div class="container">
        <a class="btn btnn" href="nuevo.php" <?php if ( $_SESSION['ROL'] == 3){ ?> style="display: none;" <?php   } ?>>NUEVO DEPOSITO</a>
        <a class="btn btnn" href="buscar.php" <?php if ( $_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3){ ?> style="display: none;" <?php   } ?>>BUSCAR DEPOSITO</a>
        <a href="modificardeposito.php" class="btn btnn" <?php if ( $_SESSION['ROL'] == 2 || $_SESSION['ROL'] == 3){ ?> style="display: none;" <?php   } ?> >MODIFICAR DEPOSITO</a> <!--ESTO ES DE ACUERDO AL ROL SI EL USARIO ES TIENE ROL 2 = VENTAS ESTE NO PODRA VER ESTOS BOTONES-->
        <a class="btn btnn" href="buscar2.php" <?php if ( $_SESSION['ROL'] == 2 ){ ?> style="display: none;" <?php   } ?> >REPORTE </a>
    </div>
    <div class="container">
        <a href="monitoreo.php" class="btn btnn" <?php if (  $_SESSION['ROL'] == 2){ ?> style="display: none;" <?php   } ?>>MONITOREO</a>
        <a href="verclientes.php" class="btn btnn" <?php if ( $_SESSION['ROL'] == 3){ ?> style="display: none;" <?php   } ?>>VER CLIENTES</a>
        <a href="editar.php" class="btn btnn" <?php if ( $_SESSION['ROL'] == 3){ ?> style="display: none;" <?php   } ?>>EDITAR</a>
    </div>
    <div class="container">
    	<a href="cajas.php" class="btn btnn"<?php if (  $_SESSION['ROL'] != 3){ ?> style="display: none;" <?php   } ?>>REPORTE DE CAJAS</a>
        <a href="logout.php" class="btn btnn">SALIR</a>
        <a href="buscarCancelados.php" class="btn btnn">CANCELADOS</a>
        <a href="mpolizas.php" class="btn btnn" <?php if (  $_SESSION['iduser'] != '11'  ){ ?> style="display: none;" <?php   } ?>>POLIZAS</a>
    </div>
    <script src="js/sweetalert-dev.js"></script>
    <!--<script type="text/javascript">
    
            swal({
                type: 'warning',
                title: 'AVISO LA SESION SE CERRARA AUTOMATICAMENTE DESPUES DE 10 MINUTOS',
                showConfirmButton: false,
                timer: 3000 // es ms (mili-segundos)
            })
        
    </script>-->
    <script type="text/javascript">
	function e(q) {
        alert("SESION CERRADA POR INACTIVIDAD");
        location.href = "login.php";
}
function inactividad() {
    e("Inactivo!!");
}
var t=null;
function contadorInactividad() {
    t=setTimeout("inactividad()",600000);
}
window.onblur=window.onmousemove=function() {
    if(t) clearTimeout(t);
    contadorInactividad();
}
</script>
    </body>
    <footer>
    </footer>
</html>
<?php
}
?>