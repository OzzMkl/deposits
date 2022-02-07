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
    <link rel="stylesheet" href="css/register.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <title>Registrar Cliente</title>
</head>
    <body>
    <?php
        $idc = "";
        $nombre = "";
        $apellidos = "";
        $terminacion =  "";
         if(isset($_POST['clave']))
        {
            $answer=$_POST['clave'];
            $sql = "SELECT * FROM clientes WHERE idc = '$answer'";
            $query = $con->query($sql);
            while($row=mysqli_fetch_assoc($query))
            {
                $idc = $row['idc'];
                $nombre = $row['nombre'];
                $apellidos = $row['apellidos'];
                $terminacion = $row['terminacion'];
            }
        } 
    ?>
        <div>
            <form action="" method="post">
                <label class="clabel">INGRESE NICK DE CLIENTE</label>
                <input type="number" name="clave" required />
                <input class="button" name="login" type="submit" value="VAMOS" />
            </form>
        </div>        
        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>EDITAR CLIENTE</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraModCliente.php">
                        <div class="row clearfix">
                            <div class="col_half">
                                <label class="clabel">Nombre(s)</label>
                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px"></i></span>
                                <input type="text" name="nombre" value="<?php echo $nombre; ?>"/>
                                </div>
                            </div>
                            <div class="col_half">
                                <label class="clabel">Apellidos</label>
                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px"></i></span>
                                <input type="text" name="apellido" value="<?php echo $apellidos; ?>" required />
                            </div>
                        </div>
                                <div class="col_half">
                                    <label class="clabel">Terminacion número de Cuenta</label>
                                    <div class="input_field"> <span><i aria-hidden="true"><img src="icons/card.png" width="26px"></i></span>
                                    <input type="text" name="terminacion" value="<?php echo $terminacion; ?>" required />
                                    </div>
                                </div>
                                <input class="button" type="submit" value="VAMOS" onclick="pregunta()"/>
                                <input type="hidden" name="idu" value="<?php echo $_SESSION['iduser']; ?>" />
                                <input type="hidden" name="idc" value="<?php echo $idc; ?>" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="editar.php" class="btn btnn">REGRESAR</a>
        </div>
        <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
        <script src="js/comparar.js"></script>
        <script src="js/funciones.js"></script>
    </body>
</html>
<?php
      
    }
?>