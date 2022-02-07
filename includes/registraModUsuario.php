<?php
include "../includes/conexion.php";

if (
    /*SE COMPRUEBA SI SE RECIBEN LOS DATOS */
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['contrasena']) &&
    isset($_POST['rcontrasena']) &&
    isset($_POST['rol'])&&
    isset($_POST['idu'])&&
    isset($_POST['idus'])

  ) {
/*LOS ASIGNAMOS AUNA VARIABLE */
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$contrasena = $_POST['contrasena'];
$rcontrasena = $_POST['rcontrasena'];
$rol = intval($_POST['rol']);
$idu = intval( $_POST['idu']);
$idus = intval( $_POST['idus']);

/*REALIZAMOS EL INSERT */
$sql = "UPDATE usuarios SET nombre= TRIM('$nombre'),apellidos=TRIM('$apellido'),contrasena= TRIM('$rcontrasena'),rol_id= TRIM('$rol') WHERE idU = $idus";
$resultado = $con->query($sql) or die("error".mysqli_errno($con));

/*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*/
$accion = "MODIFICACION A USUARIO / ID: ".$idus." / NOMBRE: ".$nombre." / ROL: ".$rol;

//con esto obtenemos el nombre del equipo NOTA: SE ESTA COMPROBANDO QUE FUNCIONE BIEN
$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

/*REALIZAMOS EL INSERT A LA TABLA DE MONITOREO */
$sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
VALUES ($idu,'$accion',NOW(),'$nombre_host')";
$resultado = $con->query($sql2) or die("error".mysqli_errno($con));

$con->close();

?>
<script>
      location.href = "../index.php";
</script>
<?php
}else {

    echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS!";

}
?>