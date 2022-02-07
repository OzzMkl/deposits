<?php
//INICIAMOS SESION
    session_start();
    require_once("includes/conexion.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet"  href="css/register.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.min.css">
    
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/sweetalert.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
	<body>

<?php

//comprobamos que recibimos los datos del login
if(isset($_POST["login"])){
    //si no estan vacios
    if(!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    $username=$_POST['usuario'];//los asignamos a variables
    $password=$_POST['contrasena'];
        //realizamos consulta con los datos para verificar el usuarios
    $query = $con->query("SELECT * FROM usuarios WHERE idu='".$username."' AND contrasena='".$password."'");

    $numrows=mysqli_num_rows($query);
    if($numrows!=0)

        {
        while($row=mysqli_fetch_assoc($query))
        {
        $dbusername=$row['idu'];
        $dbpassword=$row['contrasena'];
        }

        if($username == $dbusername && $password == $dbpassword){
                //realizamos una segunda consulta para traer la informacion del usuario logeado
                    $query2 = $con->query("SELECT * FROM usuarios WHERE idu='".$username."'");
                    $numrows2=mysqli_num_rows($query2);
                while($row=mysqli_fetch_assoc($query2))
                {//asignamos la informacion que necesitamos a variables
                    $dbnameu=$row['nombre'];
                    $dbnameuapellido=$row['apellidos'];
                    $dbrolid=$row['rol_id'];
                    $user=$row['idu'];
                }

                {
                //con sesion le asignamos la informacion del usuario logeado
                $_SESSION['session_username']=$dbnameu." ".$dbnameuapellido;
                $_SESSION['ROL']=$dbrolid;
                $_SESSION['iduser']=$user;
                $_SESSION["ultimoAcceso"]=date("Y-n-j H:i:s");
                
                /*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*
                $accion = "INICIO DE SESION USUARIO: ".$user." / NOMBRE: ".$dbnameu." / ROL: ".$dbrolid;

                //con esto obtenemos el nombre del equipo NOTA: SE ESTA COMPROBANDO QUE FUNCIONE BIEN
                $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

                /*REALIZAMOS EL INSERT A LA TABLA DE MONITOREO *
                $sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
                VALUES ($user,'$accion',NOW(),'$nombre_host')";
                $resultado = $con->query($sql2) or die("error".mysqli_errno($con));*/

                $con->close();  


                /* Redirect browser */
                header("location:index.php");
                }
            }else { $message =  "Nombre de usuario ó contraseña invalida!"; ;}
    } 
    else 
    {
        $message =  "Nombre de usuario ó contraseña invalida!";
    }
        } else {
        $message = "Todos los campos son requeridos!";
    }
    
}



?>

<div class="form_wrapper">
            <div class="form_container">
            <div id="login"> 
            <div class="title_container">
                <h2>INICIO DE SESION</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form  method="post">
                            <label class="clabel">USUARIO</label>
                            <div class="input_field"> <span><i aria-hidden="true" > <img src="icons/man.png" width="26px"> </i></span>
                                <input type="text" name="usuario" id="BENEFICIARIO" required/>
                            </div>
                            <label class="clabel">CONTRASEÑA</label>
                        <div class="input_field"> <span><i aria-hidden="true" ><img src="icons/lock.png" width="26px" ></i></span>
                            <input type="password" name="contrasena" required />
                        </div>
                        
                                <input class="button" name="login" type="submit" value="VAMOS" />
                        </form>
                    </div>
                </div>
                </div>   
            </div>
        </div>

       
        <script src="js/sweetalert-dev.js"></script>
</body>
</html>
<?php if (!empty($message)) {echo "
        <script >
      
            swal({
                type: 'error',
                title: 'Usuario o contraseña incorrecta!',
                showConfirmButton: false,
                timer: 3000 // es ms (mili-segundos)
            })
        
    </script>
        ";} ?>
	

