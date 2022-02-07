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
isset($_POST['feching']) &&
isset($_POST['idu'])&&
isset($_POST['idpoli'])





) {
  
/*SI EXISTEN SE ASIGNAN A UNA VARIABLE */
$ncb = intval($_POST['ncb']);/* SE LES PONE LA FUNCION intval() PARA CONVERTIRLOS A ENTEROS YA QUE SE RECIBEN EN STRING */
$tipo = intval($_POST['tipo']);
$monto = floatval($_POST['monto']);
$referencia_num = intval($_POST['referencia_num']);
$fecha_env = $_POST['fecha_env'];
$proveedor = $_POST['proveedor'];
$idPoliza = intval($_POST['idpoli']);
$motivo = $_POST['motivo'];
$feching = $_POST['feching'];
$idu = intval( $_POST['idu']);


// Se verifica que no haya campos con los mismos valores de referencia_num, clave_rastreo y banco
    //realizamos consulta con los datos en la base de datos
    //$conDepo = new mysqli('192.168.200.252','cardinal','ABC123.','depositosdb');
    $quer = $con->query("SELECT * FROM polizas WHERE ncb_id = '".$ncb."' AND ref_num = ".$referencia_num." AND idPoliza != ".$idPoliza."");
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
      $sql = "UPDATE poliza SET ncb_id=$ncb,tipo_id=$tipo,monto=TRIM('$monto'),
      ref_num=TRIM('$referencia_num'),fecha_envio=TRIM('$fecha_env'),proveedor='$proveedor',
      motivo=('$motivo')  WHERE idPoliza =  $idPoliza ";
      $resultado = $con->query($sql)or die("error".mysqli_errno($con));
    
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