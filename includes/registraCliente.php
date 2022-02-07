<?php
include "../includes/conexion.php";

if (
    /*SE COMPRUEBA SI SE RECIBEN LOS DATOS */
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['numcuenta']) &&
    isset($_POST['idu'])

  ) {
/*LOS ASIGNAMOS AUNA VARIABLE */
$nombre =strtoupper($_POST['nombre']);
$apellido = strtoupper($_POST['apellido']);
$numcuenta = $_POST['numcuenta'];
$idu = intval( $_POST['idu']);
/*VERIFICAMOS SI EXISTE EL CLIENTE */
$nombre_completo=$nombre.' '.$apellido;
$verificar_nombre = "SELECT * FROM clientes WHERE CONCAT(nombre,' ',apellidos)  = '$nombre_completo'";
$cc = $con->query($verificar_nombre) or die ("Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error);
$nr = mysqli_num_rows($cc);
if($nr>0){
  echo'<script type="text/javascript">
  alert("Error el cliente YA EXISTE!!");
 </script>';
?>
<script>
window.history.back();
</script>
<?php
}else{

  /*REALIZAMOS EL INSERT */
$sql = "INSERT INTO clientes (idc, nombre, apellidos, terminacion) 
VALUES (NULL, '$nombre','$apellido',$numcuenta)";
$resultado = $con->query($sql) or die("error".mysqli_errno($con));

/*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*/
$accion = "ALTA CLIENTE: ".$nombre." ".$apellido." / TERMINACION: ".$numcuenta;

//con esto obtenemos el nombre del equipo NOTA: SE ESTA COMPROBANDO QUE FUNCIONE BIEN
$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

/*REALIZAMOS EL INSERT A LA TABLA DE MONITOREO */
$sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
VALUES ($idu,'$accion',NOW(),'$nombre_host')";
$resultado = $con->query($sql2) or die("error".mysqli_errno($con));

$con->close();

?>
<script>
      location.href = "../editar.php"; 
</script>
<?php
}

}else {

    echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS!";

}
?>