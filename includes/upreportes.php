<?php
include "../includes/conexion.php";

if (
    /*SE COMPRUEBA SI SE RECIBEN LOS DATOS */
    isset($_POST['clave']) &&
    isset($_POST['statuss']) &&
    isset($_POST['idu']) &&
    isset($_POST['iduname'])&&
    isset($_POST['idurol'])

  ) {
/*LOS ASIGNAMOS AUNA VARIABLE */
$clave = intval( $_POST['clave']);
$statuss = intval( $_POST['statuss']);
$idu = intval( $_POST['idu']);
$iduname = $_POST['iduname'];
$rol = intval($_POST['idurol']);
$campo='';
$ncampo='';
$campo2='';
/*CONSULTAMOS SI EXISTE EL DEPOSITO ANTES DE REALIZAR CUALQUIER ACCIÓN */
$query = $con->query("SELECT * FROM deposito WHERE idDeposito='".$clave."'");

    $numrows=mysqli_num_rows($query);
    if($numrows!=0){

		if($rol==3){	$campo='statusC'; $ncampo='STATUSC'; $campo2='cambiosC';}
		else { $campo='statuss'; $ncampo='STATUS'; $campo2='cambios'; }

		/*REALIZAMOS EL UPDATE */
		$sql = "UPDATE deposito  SET $campo= $statuss, $campo2=TRIM('$iduname') WHERE idDeposito = $clave";
		$resultado = $con->query($sql) or die("error".mysqli_errno($con));



		/***CONSULTA PARA OBTENER NOMBRE DEL STATUS PARA INGRESARLO EN MONITOREO */
		$query = $con->query("SELECT nombre FROM estado WHERE ide = $statuss");
		$numrows=mysqli_num_rows($query);
		while($row=mysqli_fetch_assoc($query))
		{
		$statusss=$row['nombre'];
		}

		/*Esto se hace para unir los valores a insertar en monitoreo en la columna accion*/
		$accion = "MODIFICACION A ".$ncampo." DE DEPOSITO CON ID: ".$clave." / ".$ncampo.": ".$statusss;

		//con esto obtenemos el nombre del equipo NOTA: SE ESTA COMPROBANDO QUE FUNCIONE BIEN
		$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

		/*REALIZAMOS EL INSERT A LA TABLA DE MONITOREO */
		$sql2 = "INSERT INTO monitoreo (idu, accion, fecha_hora, maquina) 
		VALUES ($idu,'$accion',NOW(),'$nombre_host')";
		$resultado = $con->query($sql2) or die("error".mysqli_errno($con));

		$con->close();

		?>
		<script>
		      location.href = "../buscar2.php";
		</script>
		<?php
	}
    else{
      echo'<script type="text/javascript">
      alert("ERROR, EL DEPÓSITO NO EXISTE");
      window.location.href="/depositos1.0/buscar2.php";
      </script>';
    }
}else {

    echo "ERROR AL INSERTAR DATOS EN LA BASE DE DATOS!";

}
?>