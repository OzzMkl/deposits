<?php 
session_start();

include ("includes/conexion.php");

/*LOS ASIGNAMOS A UNA VARIABLE */
$nombre = $_SESSION['session_username'];
$rol = $_SESSION['ROL'];
$idu = $_SESSION['iduser'];

/*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*
$accion = "CIERRE DE SESION USUARIO: ".$idu." / NOMBRE: ".$nombre." / ROL: ".$rol;

//con esto obtenemos el nombre del equipo NOTA: SE ESTA COMPROBANDO QUE FUNCIONE BIEN
$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

/*REALIZAMOS EL INSERT A LA TABLA DE MONITOREO *
$sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
VALUES ($idu,'$accion',NOW(),'$nombre_host')";
$resultado = $con->query($sql2) or die("error".mysqli_errno($con));*/
$con->close();  

session_destroy();
header("location:login.php");

?>