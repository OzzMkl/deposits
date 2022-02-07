<?php
include "../includes/conexion.php";

if (
    /*SE COMPRUEBA SI SE RECIBEN LOS DATOS */
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['terminacion']) &&
    isset($_POST['idu'])&&
    isset($_POST['idc'])
  ) 
{
  /*LOS ASIGNAMOS A UNA VARIABLE */
  $nombre = strtoupper($_POST['nombre']);
  $apellido = strtoupper($_POST['apellido']);
  $terminacion = $_POST['terminacion'];
  $idu = intval( $_POST['idu']);
  $idc = intval( $_POST['idc']);

  /**Se hace esta consulta para obtener los datos anteriores a actualizar*/
  //$conDepo = new mysqli('192.168.200.252','cardinal','ABC123.','depositosdb');
  $sql="SELECT CONCAT(nombre,' ',apellidos)  FROM clientes WHERE idc='$idc'";

  $consultaOld = $con->query($sql) or die ("Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error);
  $registroD = mysqli_fetch_array($consultaOld);
  do{
    $oldName = $registroD[0];

  }while($registroD = mysqli_fetch_array($consultaOld));
  /*Cerramos conexion */

    /*REALIZAMOS EL UPDATE */
    $sql3 = "UPDATE clientes SET nombre= TRIM('$nombre'),apellidos=TRIM('$apellido'),
    terminacion=TRIM('$terminacion') WHERE idc = $idc";

    $resultado = $con->query($sql3) or die("error".mysqli_errno($con));

    /*$sql2 = "UPDATE deposito SET cliente = CONCAT(TRIM('$nombre'),' ',TRIM('$apellido'))
     WHERE cliente = '$oldName'";
    $resultado = $con->query($sql2) or die("error".mysqli_errno($con));*/



    /*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*/
    $accion = "MODIFICACION A CLIENTE: ".$nombre." ".$apellido." / TERMINACION: ".$terminacion." / ID:".$idc;

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
else 
{
  echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS! ";
  
}
?>