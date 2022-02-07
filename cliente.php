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
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
</head>
    <body>
        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>REGISTRAR CLIENTE</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraCliente.php">
                        <div class="row clearfix">
                            <div class="col_half">
                                <label class="clabel">Nombre(s)</label>
                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px"></i></span>
                                <input type="text" name="nombre"/>
                                </div>
                            </div>
                            <div class="col_half">
                                <label class="clabel">Apellidos</label>
                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px"></i></span>
                                <input type="text" name="apellido" required />
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                                <div class="col_half">
                                    <label class="clabel">Terminacion número de Cuenta</label>
                                    <div class="input_field"> <span><i aria-hidden="true"><img src="icons/card.png" width="26px"></i></span>
                                    <input type="text" name="numcuenta"/>
                                    </div>
                                </div>
                                <div class="col_half">
                                    <p class="clabel">Si desea agregar otro numero de cuenta edite el cliente ;)</p>
                                </div>
                        </div>
                                
                              
                                <input class="button" type="submit" value="VAMOS" onclick="pregunta()"/>
                                <input type="hidden" name="idu" value="<?php echo $_SESSION['iduser']; ?>" />
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