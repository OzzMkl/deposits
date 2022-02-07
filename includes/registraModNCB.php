<?php
include "../includes/conexion.php";

if (
    /*SE COMPRUEBA SI SE RECIBEN LOS DATOS */
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['banco']) &&
    isset($_POST['numcuenta']) &&
    isset($_POST['transferencia'])&&
    isset($_POST['idu'])&&
    isset($_POST['idn'])
  ) 
{
  /*LOS ASIGNAMOS A UNA VARIABLE */
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $banco = $_POST['banco'];
  $numcuenta = $_POST['numcuenta'];
  $transferencia = $_POST['transferencia'];
  $idu = intval( $_POST['idu']);
  $idn = intval( $_POST['idn']);

// Se verifica que no haya campos con los mismos valores de referencia_num, clave_rastreo y banco
  //realizamos consulta con los datos en la base de datos
  //$conDepo = new mysqli('192.168.200.252','cardinal','ABC123.','depositosdb');
  $quer = $con->query("SELECT * FROM ncb WHERE banco = '".$banco."' AND ncuenta = ".$numcuenta."");
  $numrows=mysqli_num_rows($quer);
    
  //Si la consulta regresa algún valor quiere decir que ya existen esos datos en el sistema,
  //por lo tanto se regresa al usuario a la página anterior ( nuevo.php )
  if($numrows > 0 )
  {
    echo'<script type="text/javascript">
            alert("Error, verificar el Banco y la Cuenta");
           </script>';
    ?>
    <script>
      window.history.back();
    </script>
    <?php
  }
  else
  {

    /*REALIZAMOS EL INSERT */
    $sql = "UPDATE ncb SET nombre= TRIM('$nombre'),apellidos=TRIM('$apellido'),banco=TRIM('$banco'),
    ncuenta=TRIM('$numcuenta'),ntransferencia=TRIM('$transferencia') WHERE idn = $idn";
    $resultado = $con->query($sql) or die("error".mysqli_errno($con));

    /*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*/
    $accion = "MODIFICACION A NCB / BANCO: ".$banco." / NUM. CUENTA: ".$numcuenta."";

    //con esto obtenemos el nombre del equipo NOTA: SE ESTA COMPROBANDO QUE FUNCIONE BIEN
    $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    /*REALIZAMOS EL INSERT A LA TABLA DE MONITOREO */
    $sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
    VALUES ($idu,'$accion',NOW(),'$nombre_host')";
    $resultado = $con->query($sql2) or die("error".mysqli_errno($con));

    $con->close();

    echo  '<script type="text/javascript"> alert("GUARDADO EXITOSAMENTE"); </script>';
    ?>
    <script>
            location.href = "../index.php";
    </script>
    <?php
  }
}
else 
{
  echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS! NCB";
}
?>