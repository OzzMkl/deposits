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
isset($_POST['clave_rastreo']) &&
isset($_POST['fecha_env']) &&
isset($_POST['cliente']) &&
isset($_POST['example']) &&//banco
isset($_POST['factura']) &&
isset($_POST['folio_remision']) &&
isset($_POST['sucursal']) &&
isset($_POST['cambios']) &&
//isset($_POST['motivo']) &&
isset($_POST['feching']) &&
isset($_POST['idu'])&&
isset($_POST['idepo'])&&
isset($_POST['statuss'])&&
isset($_POST['observaciones'])





) {
  
/*SI EXISTEN SE ASIGNAN A UNA VARIABLE */
$ncb = intval($_POST['ncb']);/* SE LES PONE LA FUNCION intval() PARA CONVERTIRLOS A ENTEROS YA QUE SE RECIBEN EN STRING */
$tipo = intval($_POST['tipo']);
$monto = floatval($_POST['monto']);
$referencia_num = $_POST['referencia_num'];
$clave_rastreo = $_POST['clave_rastreo'];
$fecha_env = $_POST['fecha_env'];
$cliente = trim($_POST['cliente']);
$banco = trim($_POST['example']);
$idDeposito = intval($_POST['idepo']);
$cambios = $_POST['cambios'];
//$motivo = $_POST['motivo'];
$feching = $_POST['feching'];
$statuss = $_POST['statuss'];
$observaciones = $_POST['observaciones'];



/**Se hace esta consulta para convertir el nombre del banco a  su ID de la tabla*/
  $sql="SELECT idb FROM bancos WHERE banco='$banco'";
  $consultaBANCO = $con->query($sql) or die ("Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error);
  $registroD = mysqli_fetch_array($consultaBANCO);
  do{
    $bank = intval($registroD[0]);
  }while($registroD = mysqli_fetch_array($consultaBANCO));
/*Cerramos conexion */

$s="SELECT * FROM clientes WHERE CONCAT(nombre,' ',apellidos)  = '$cliente'";

$cc = $con->query($s) or die ("Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error);
$nr = mysqli_num_rows($cc);
if($nr<=0){
  echo'<script type="text/javascript">
  alert("Error el cliente no existe");
 </script>';
?>
<script>
window.history.back();
</script>
<?php
}else{
    
  $re = mysqli_fetch_array($cc);
  do{
    $idc = intval($re[0]);
  }while($re = mysqli_fetch_array($cc));
    


// Se verifica que no haya campos con los mismos valores de referencia_num, clave_rastreo y banco
    //realizamos consulta con los datos en la base de datos
   // $con= new mysqli('192.168.200.252','cardinal','ABC123.','depositosdb');
   $quer = $con->query("SELECT * FROM deposito WHERE clave_rastreo = '".$clave_rastreo."' AND ref_num = '".$referencia_num."' AND idDeposito != ".$idDeposito."");
   $numrows=mysqli_num_rows($quer);
   
   //Si la consulta regresa alg??n valor quiere decir que ya existen esos datos en el sistema,
   //por lo tanto se regresa al usuario a la p??gina anterior ( nuevo.php )
   if($numrows > 0 )
   {
     echo'<script type="text/javascript">
           alert("Error, verificar la Referencia Num??rica y la Clave de Rastreo");
          </script>';
     ?>
     <script>
       window.history.back();
     </script>
     <?php
   }
   else
   { 

     $factura = $_POST['factura'];
     $folio_remision =$_POST['folio_remision'];
     $sucursal = $_POST['sucursal'];
     $idu = intval( $_POST['idu']);


     /**INSERTAMOS LOS DATOS EN LA TABLA DEPOSITO */
     
     $sql = "UPDATE deposito SET ncb_id=$ncb,tipo_id=$tipo,monto=TRIM('$monto'),
     clave_rastreo=TRIM('$clave_rastreo'),ref_num=TRIM('$referencia_num'),
     fecha_envio=TRIM('$fecha_env'),idc=$idc,banco_emisor_id=$bank,
     factura=TRIM('$factura'),folio_remision='$folio_remision' ,
     sucursal=TRIM('$sucursal'),statuss=TRIM('$statuss'),cambios=TRIM('$cambios'),
     observaciones=TRIM('$observaciones')
      WHERE idDeposito =  $idDeposito ";
      
      

     $resultado = $con->query($sql)or die("error".mysqli_errno($con));
   
     /***FUNCIONES DE MONITOREO */
     /**CREANOS LA ACCION A INSERTAR */
     $accion = "MODIFICACION DE DEPOSITO NO. ".$idDeposito;
     /**OBTENEMOS EL NOMBRE DEL EQUIPO */
     $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
     /**INSERTAMOS EN MONITOREO */
     $sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
     VALUES ($idu,'$accion',NOW(),'$nombre_host')";
     $resultado = $con->query($sql2) or die("error".mysqli_errno($con));
     /**CERRAMOS CONEXIONES */
    
     $con->close();
?>

<!--ESTE SCRIPT ES PARA REDIRECCIONAR A  LA PAGINA PRINCIPAL-->
<script>
     location.href = "../index.php";
</script>

<?php
   }

  }
}else 
{
  /*ESTE MENSAJE SALDRA EN UNA PAGINA EN BLANCO */
    echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS!";
}
?>  