<?php 
//INICIAMOS SESION
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");//SI NO EXISTE LO MANDAMOS A LOGIN
    } else {//SI CUMPLE CON EL ROL INGRESA A LA  PAGINA SI NO SERA MANDADO A INDEX
        if ($_SESSION["ROL"] == 1){
include "includes/conexion.php";//INCLUIMOS VARIABLES DE CONEXION
                    ///DECLARAMOS LAS VARIABLES A USAR PARA QUE NO GENEREN ERRORES
                    $idDeposito = "";
                    $ncb_id = "";
                    $tipo_id = "";
                    $monto = "";
                    $clave_rastreo = "";
                    $ref_num = "";
                    $fecha_envio = "";
                    $idc = "";  
                    $banco_emisor_id = "";
                    $factura = "";
                    $folio_remision = "";
                    $sucursal = "";
                    $usuario_id = "";
                    $statuss = "";
                    $cambios = "";
                    $bank="";
                    $fecha_ingreso = ""; 
                    $observaciones = "";

            if(isset($_POST['clave']))//SI SE RECIBE EL ID DEL DEPOSITO A BUSCAR ENTRAMOS AL IF
            {
                $answer=$_POST['clave'];//ASIGNAMOS CLAVE A UNA VARIABLE
                $sql = "SELECT * FROM deposito WHERE idDeposito = '$answer'";//CONSULTA PARA SABER SI EXISTE EL ID DEL DEPOSITO
            
                $query = $con->query($sql);
                  while($row=mysqli_fetch_assoc($query))
                  {//RECORREMOS EÑL ARRAY Y ASIGNAMOS LOS DATOS A VARIABLES
                    $idDeposito = $row['idDeposito'];
                    $ncb_id = $row['ncb_id'];
                    $tipo_id = $row['tipo_id'];
                    $monto = floatval($row['monto']);
                    $clave_rastreo = $row['clave_rastreo'];
                    $ref_num = $row['ref_num'];
                    $fecha_envio = $row['fecha_envio'];
                    $idc = $row['idc'];   
                    $banco_emisor_id = $row['banco_emisor_id'];
                    $factura = $row['factura'];
                    $folio_remision = $row['folio_remision'];
                    $sucursal = $row['sucursal'];
                    $usuario_id = $row['usuario_id'];
                    $statuss = $row['statuss'];
                    $cambios = $row['cambios'];
                    $fecha_ingreso = $row['fecha_ingreso'];
                    $observaciones = $row['observaciones'];
                  }
                
                $sql3="SELECT banco FROM bancos WHERE idb='$banco_emisor_id'";//CONSULTA PARA TRAER EL NOMBRE DEL BANCO 
                $consultaBANCO = $con->query($sql3) or die ("Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error);
                $registroD = mysqli_fetch_array($consultaBANCO);
                do{
                    if(isset($registroD[0])){
                        $bank = $registroD[0];
                    }
                    //$bank = $registroD[0];//ASIGNAMOS EL NOMBRE A UNA VARIABLE
                }while($registroD = mysqli_fetch_array($consultaBANCO));
                //$k="selected";

                $sql4 = "SELECT * FROM clientes WHERE idc = '$idc'";
                $consultaCLIENTE = $con->query($sql4);
                while($r=mysqli_fetch_assoc($consultaCLIENTE))
                  {//RECORREMOS EÑL ARRAY Y ASIGNAMOS LOS DATOS A VARIABLES
                    $cliente = $r['nombre'].' '.$r['apellidos'];
                  }


            }
                
                ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Deposito</title>
</head>
<body>

<div>
                  <form action="" method="post">
                        <label class="clabel">INGRESE ID DE DEPÓSITO</label>
                        <input type="number" name="clave" required />
                        <input class="button" name="login" type="submit" value="VAMOS" />
                  </form>
                </div>

        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>MODIFICAR DEPOSITO</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraModDepo.php">
                        <div class="input_field select_option" >
                                <select name="ncb" id="ncb" onchange="cambioOpciones();">
                                <option value="0">SELECCIONA EL NUMERO DE CUENTA</option>
                                <?php //CONSULTA PARA TRAER LOS DATOS DE LA TABLA NUMERO DE CUENTA DE BENEFICIARIO
                                    $query = $con -> query ("SELECT * FROM ncb LIMIT 4");
                                    while ($r = mysqli_fetch_array($query)){
                                        if($r['idn']==$ncb_id){//SE COMPARA CON EL ID DEL DEPOSITO A RECIBIR SI ES IGUAL SE LE MARCA COMO SELECCIONADO
                                            echo ' <option value="'.$r['idn'].'" selected >'.$r['banco'].'</option>';
                                        }else{
                                            echo ' <option value="'.$r['idn'].'">'.$r['banco'].'</option>';//SI NO ES IGUAL SE AGREGAN LAS DEMAS OPCIONES PARA MODIFICAR
                                        }
                                        
                                    }
                                ?>
                                </select>
                                <div class="select_arrow"></div>
                            </div>

                            <label class="clabel">BENEFICIARIO</label>
                            <div class="input_field"> <span><i aria-hidden="true" > <img src="icons/lock.png" width="26px"> </i></span>
                                <input type="text" name="beneficiario" id="BENEFICIARIO" readonly />
                            </div>

                            <label class="clabel">BANCO</label>
                            <div class="input_field"> <span><i aria-hidden="true" ><img src="icons/lock.png" width="26px"></i></span>
                                <input type="text" name="banco" id="BANCO" readonly="readonly"  readonly/>
                            </div>

                            <label class="clabel">CUENTA</label>
                            <div class="input_field"> <span><i aria-hidden="true" ><img src="icons/lock.png" width="26px"></i></span>
                                <input type="text" name="cuenta" id="CUENTA" readonly  />
                            </div>

                            <label class="clabel">TRANSFERENCIA</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/lock.png" width="26px"></i></span>
                                <input type="text" name="transferencia" id="TRANSFERENCIA" readonly  />
                            </div>
                            
                            <div class="input_field select_option" >
                                <select name="tipo" id="tipo">
                                <option value="0">SELECCIONA EL TIPO DE PAGO</option>
                                <?php //CONSULTA PARA TRAER LOS DATOS DE LA TABLA transaccion
                                    $query = $con -> query ("SELECT * FROM transaccion");
                                    while ($r3 = mysqli_fetch_array($query)){
                                        if($r3['idt']==$tipo_id){//SE COMPARA CON EL ID DE LA TRANSACCION A RECIBIR SI ES IGUAL SE LE MARCA COMO SELECCIONADO
                                            echo ' <option value="'.$r3['idt'].'" selected >'.$r3['tipo'].'</option>';
                                        }else{
                                            echo ' <option value="'.$r3['idt'].'">'.$r3['tipo'].'</option>';//SI NO ES IGUAL SE AGREGAN LAS DEMAS OPCIONES PARA MODIFICAR
                                        }
                                        
                                    }
                                ?>
                                </select>
                                <div class="select_arrow"></div>
                            </div>
                            
                            <label class="clabel">MONTO</label>
                            <div class="input_field"> <span><i aria-hidden="true" > <img src="icons/cash.png" width="26px" > </i></span>
                                <input type="text" name="monto" id="MONTO" step="any" value="<?php echo $monto; ?>" required />
                            </div>
                            
                            <label class="clabel">REFERENCIA NUMERICA</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="referencia_num" id="REFERENCIA_NUM" value="<?php echo $ref_num; ?>" required />
                            </div>
                            <label class="clabel">CLAVE DE RASTREO</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="clave_rastreo" id="CLAVE_RASTREO" value="<?php echo $clave_rastreo; ?>" required />
                            </div>

                            <label class="clabel">FECHA DE OPERACION</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/calendar.png" width="26px" ></i></span>
                                <input type="text" name="fecha_env" id="FECHA_ENV" value="<?php echo $fecha_envio; ?>" required />
                            </div>
                            <label class="clabel">CLIENTE</label>
                            <div class="input_field">
                            <span><i aria-hidden="true"><img src="icons/man.png" width="26px" ></i></span>
                                <input type="text" name="cliente" id="CLIENTE" list="client" value="<?php echo $cliente; ?>">
                                    <datalist id="client">
                                    <?php 
                                    //hacemos consulta a bancos para traer su nombre y cargarlos en un datalist
                                    $query = $con -> query ("SELECT * FROM clientes");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['nombre'].' '.$r['apellidos'].'">';
                                    }
                                ?>
                                    </datalist>  
                            </div>
                            <!--********************************************-->
                            <label class="clabel">BANCO EMISOR</label>
                            <div class="input_field">
                            <span><i aria-hidden="true"><img src="icons/bank.png" width="26px" ></i></span>
                                <input type="text" name="example" list="exampleList" value="<?php echo $bank; ?>">
                                    <datalist id="exampleList">
                                    <?php 
                                    //hacemos consulta a bancos para traer su nombre y cargarlos en un datalist
                                    $query = $con -> query ("SELECT * FROM bancos");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['banco'].'">';
                                    }
                                ?>
                                </datalist>
                                </div>
                            <label class="clabel">FACTURA</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/invoice.png" width="26px" ></i></span>
                                <input type="text" name="factura" id="FACTURA" value="<?php echo $factura; ?>" required />
                            </div>

                            <label class="clabel">FOLIO REMISION</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="folio_remision" id="FOLIO_REMISION" value="<?php echo $folio_remision; ?>" required />
                            </div>
                            <div class="input_field select_option" >
                                <select name="sucursal" id="sucursal">
                                <option value="0">SELECCIONA LA SUCURSAL</option>
                                <?php //CONSULTA PARA TRAER LOS DATOS DE LA TABLA NUMERO DE CUENTA DE BENEFICIARIO
                                    $query = $con -> query ("SELECT * FROM sucursal");
                                    while ($r = mysqli_fetch_array($query)){
                                        if($r['nombre']==$sucursal){//SE COMPARA CON EL ID DEL DEPOSITO A RECIBIR SI ES IGUAL SE LE MARCA COMO SELECCIONADO
                                            echo ' <option value="'.$r['nombre'].'" selected >'.$r['nombre'].'</option>';
                                        }else{
                                            echo ' <option value="'.$r['nombre'].'">'.$r['nombre'].'</option>';//SI NO ES IGUAL SE AGREGAN LAS DEMAS OPCIONES PARA MODIFICAR
                                        }
                                        
                                    }
                                ?>
                                </select>
                                <div class="select_arrow"></div>
                            </div>

                            <div class="input_field select_option">
                                <select name="statuss">
                                <option>SELECCIONA SU ESTADO</option>
                                <option value="0" <?php if(intval($statuss) == "0") echo "selected"; ?> >SIN REVISAR</option>
                                <option value="1" <?php if(intval($statuss) == "1") echo "selected"; ?> >REVISADO</option>
                                <option value="2" <?php if(intval($statuss) == "2") echo "selected"; ?> >CANCELADO</option>
                                </select>
                                <div class="select_arrow"></div>
                            </div>

                            <label class="clabel">CAMBIOS AUTORIZADO POR:</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/right-alignment.png" width="26px" ></i></span>
                                <input type="text" name="cambios" id="CAMBIOS" value="<?php echo $_SESSION['session_username']; ?>" readonly required />
                            </div>
                            <label class="clabel">FECHA DE INGRESO</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/right-alignment.png" width="26px" ></i></span>
                                <input type="text" name="feching" id="FECHING" value="<?php echo $fecha_ingreso; ?>" readonly  required />
                            </div>
                            <label class="clabel">OBSERVACIONES</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/buscar.png" width="26px" ></i></span>
                                <input type="text" name="observaciones" id="OBSERVACIONES" value="<?php echo $observaciones; ?>" required />
                            </div>
                                <input type="hidden" name="idepo" value="<?php echo $idDeposito; ?>" />
                                <input type="hidden" name="idu" value="<?php echo $_SESSION['iduser']; ?>" />
                                <input class="button" type="submit" value="GUARDAR" onclick="pregunta()"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="index.php" class="btn btnn">REGRESAR</a>
        </div>
        
        <script src="js/nuevo.js"></script>
        <script src="js/funciones.js"></script>
</body>
</html>
<?php
      }
        else{
    header("location:index.php");
}
    }
?>