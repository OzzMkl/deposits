<?php
/**MANTENEMOS LA SESION */
session_start();
/**INCLUIMOS ARCHIVO DE CONEXION */
include "../includes/conexion.php";
if (
  /*SE COMPRUEBA SI SE RECIBEN LOS DATOS */
isset($_POST['ncb']) &&
isset($_POST['tipo']) &&
isset($_POST['monto']) &&
isset($_POST['referencia_num']) &&
isset($_POST['fecha_env']) &&
isset($_POST['proveedor']) &&
isset($_POST['motivo']) &&
isset($_POST['idu'])



) {
  
/*SI EXISTEN SE ASIGNAN A UNA VARIABLE */
$ncb = intval($_POST['ncb']);/* SE LES PONE LA FUNCION intval() PARA CONVERTIRLOS A ENTEROS YA QUE SE RECIBEN EN STRING */
$tipo = intval($_POST['tipo']);
$monto = floatval($_POST['monto']);
$referencia_num = intval($_POST['referencia_num']);
$fecha_env = $_POST['fecha_env'];
$prov = $_POST['proveedor'];
$motivo = $_POST['motivo'];
$idu = intval( $_POST['idu']);

// Se verifica que no haya campos con los mismos valores de referencia_num, clave_rastreo y banco
    //realizamos consulta con los datos en la base de datos
    //$conDepo = new mysqli('192.168.200.252','cardinal','ABC123.','depositosdb');
    $quer = $con->query("SELECT * FROM polizas WHERE ncb_id = '".$ncb."' AND ref_num = ".$referencia_num."");
    echo $quer;
    $numrows=mysqli_num_rows($quer);
    
    //Si la consulta regresa algún valor quiere decir que ya existen esos datos en el sistema,
    //por lo tanto se regresa al usuario a la página anterior ( nuevo.php )
    if($numrows > 0 )
    {
      echo'<script type="text/javascript">
            alert("Error, verificar la Referencia Numérica");
           </script>';
      ?>
      <script>
        window.history.back();
      </script>
      <?php
    }
    else
    { 
      /**INSERTAMOS LOS DATOS EN LA TABLA POLIZAS */
     // $conDepos = new mysqli('192.168.200.252','cardinal','ABC123.','depositosdb');
      $sql666 = "INSERT INTO poliza (ncb_id, tipo_id, monto, ref_num, fecha_envio, proveedor, usuario_id, motivo, fecha_ingreso)
      VALUES ('$ncb','$tipo','$monto','$referencia_num','$fecha_env','$prov',$idu,'$motivo',NOW())";
      echo $sql666;
      $resultado = $con->query($sql666)or die("error".mysqli_errno($con));

      
      /**CERRAMOS CONEXIONES */
     // $conDepo->close();
     // $conDepos->close();
      $con->close();
?>

<!--ESTE SCRIPT ES PARA REDIRECCIONAR A  LA PAGINA PRINCIPAL-->
<script>
      location.href = "../mpolizas.php";
</script>

<?php
    }
}else 
{
  /*ESTE MENSAJE SALDRA EN UNA PAGINA EN BLANCO */
    echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS!";
}
?>