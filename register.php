<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
        
        if ($_SESSION["ROL"] == 1){

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
    <title>Registrar Usuario</title>
</head>
    <body>
        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>REGISTRAR USUARIO</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraUsuario.php">
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
                        <label class="clabel">Contraseña</label>
                        <div class="input_field"> <span><i aria-hidden="true"><img src="icons/lock.png" width="26px"></i></span>
                            <input type="password" name="contrasena" placeholder="Contraseña" required />
                        </div>
                        <label class="clabel">Reingresa la contraseña</label>
                        <div class="input_field"> <span><i aria-hidden="true"><img src="icons/lock.png" width="26px"></i></span>
                            <input type="password" name="rcontrasena" placeholder="Contraseña" required />
                        </div>
                            <div class="input_field select_option">
                                <select name="rol">
                                <option >SELECCIONA EL ROL</option>
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">VENDEDOR</option>
                                <option value="3">CAJA</option>
                                </select>
                                <div class="select_arrow"></div>
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
        else{
    header("location:index.php");
}
    }
?>