<?php
    session_start();
    include "../includes/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet"  href="../css/register.css">    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Usuario</title>
</head>
<body>
<?php

$query = $con->query("SELECT * FROM usuarios ORDER by idu DESC LIMIT 1");

$numrows=mysqli_num_rows($query);
while($row=mysqli_fetch_assoc($query))
{
$idu=$row['idu'];
$contrasena=$row['contrasena'];
}
?>

<div class="form_wrapper">  
            <div class="form_container">
            <div id="login"> 
            <div class="title_container">
                <h2>DATOS DE USUARIO</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form>
                            <label class="clabel">USUARIO</label>
                            <div class="input_field"> <span><i aria-hidden="true" > <img src="../icons/man.png" width="26px"> </i></span>
                                <input type="text" name="usuario" id="BENEFICIARIO" value="<?php echo $idu; ?>" readonly/>
                            </div>
                            <label class="clabel">CONTRASEÑA</label>
                            <div class="input_field"> <span><i aria-hidden="true" ><img src="../icons/lock.png" width="26px" ></i></span>
                                <input type="text" name="contrasena"  value="<?php echo $contrasena; ?>" readonly  />
                            </div>
                        </form>
                    </div>
                </div>
                </div>   
            </div>
        </div>
        <div class="container">
        <a href="../index.php" class="btn btnn">REGRESAR</a>
    </div>
</body>
</html>
 