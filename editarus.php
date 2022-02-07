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
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
    <body>
    <?php

$idu = "";
$nombre = "";
$apellidos = "";
$contrasena =  "";
$rol =  "";
            if(isset($_POST['clave']))
            {
                $answer=$_POST['clave'];
                $sql = "SELECT * FROM usuarios WHERE idu = '$answer'";
            
                $query = $con->query($sql);
                  while($row=mysqli_fetch_assoc($query))
                  {
                    $idu = $row['idu'];
                    $nombre = $row['nombre'];
                    $apellidos = $row['apellidos'];
                    $contrasena = $row['contrasena'];
                    $rol = $row['rol_id']; 
                  }
            }
                
                ?>
                <div>
                  <form action="" method="post">
                        <label class="clabel">INGRESE NICK DE USUARIO</label>
                        <input type="number" name="clave" required />
                        <input class="button" name="login" type="submit" value="BUSCAR" />
                  </form>
                </div>
        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>EDITAR USUARIO</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraModUsuario.php">
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
                        </div>
                        <label class="clabel">Contraseña</label>
                        <div class="input_field"> <span><i aria-hidden="true"><img src="icons/lock.png" width="26px"></i></span>
                            <input type="password" name="contrasena" placeholder="Contraseña" value="<?php echo $contrasena; ?>"required />
                        </div>
                        <label class="clabel">Reingresa la contraseña</label>
                        <div class="input_field"> <span><i aria-hidden="true"><img src="icons/lock.png" width="26px"></i></span>
                            <input type="password" name="rcontrasena" placeholder="Contraseña" value="<?php echo $contrasena; ?>" required />
                        </div>
                            <div class="input_field select_option">
                            <?php if($rol == 1){$a="ADMINISTRADOR";$av=1;}else{$v="ventas"; $vv=2;}?>
                                <select name="rol">
                                <option >SELECCIONA EL ROL</option>
                                <option value="1"  <?php if(intval($rol) == 1) echo "selected"; ?>>ADMINISTRADOR</option>
                                <option value="2"  <?php if(intval($rol) == 2) echo "selected"; ?>>VENDEDOR</option>
                                <option value="3"  <?php if(intval($rol) == 3) echo "selected"; ?>>CAJA</option>
                                </select>
                                <div class="select_arrow"></div>
                            </div>
                                <input class="button" type="submit" value="VAMOS" onclick="pregunta()"/>
                                <input type="hidden" name="idu" value="<?php echo $_SESSION['iduser']; ?>" />
                                <input type="hidden" name="idus" value="<?php echo $idu; ?>" />
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