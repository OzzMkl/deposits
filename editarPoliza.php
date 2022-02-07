<?php 
//INICIAMOS SESION
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");//SI NO EXISTE LO MANDAMOS A LOGIN
    } else {//SI CUMPLE CON EL ROL INGRESA A LA  PAGINA SI NO SERA MANDADO A INDEX
        if ($_SESSION['iduser'] != '11')
        {
            header("location:index.php");
        }
        else{
include "includes/conexion.php";//INCLUIMOS VARIABLES DE CONEXION
                    ///DECLARAMOS LAS VARIABLES A USAR PARA QUE NO GENEREN ERRORES
                    $idPoliza = "";
                    $ncb_id = "";
                    $tipo_id = "";
                    $monto = "";
                    $ref_num = "";
                    $fecha_envio = "";
                    $proveedor = "";
                    $usuario_id = "";
                    $motivo = "";
                    $fecha_ingreso = ""; 

            if(isset($_POST['clave']))//SI SE RECIBE EL ID DEL DEPOSITO A BUSCAR ENTRAMOS AL IF
            {
                $answer=$_POST['clave'];//ASIGNAMOS CLAVE A UNA VARIABLE
                $sql = "SELECT * FROM poliza WHERE idPoliza = '$answer'";//CONSULTA PARA SABER SI EXISTE EL ID DEL DEPOSITO
            
                $query = $con->query($sql);
                  while($row=mysqli_fetch_assoc($query))
                  {//RECORREMOS EÑL ARRAY Y ASIGNAMOS LOS DATOS A VARIABLES
                    $idPoliza = $row['idPoliza'];
                    $ncb_id = $row['ncb_id'];
                    $tipo_id = $row['tipo_id'];
                    $monto = floatval($row['monto']);
                    $ref_num = $row['ref_num'];
                    $fecha_envio = $row['fecha_envio'];
                    $proveedor = $row['proveedor'];
                    $usuario_id = $row['usuario_id'];
                    $motivo = $row['motivo'];
                    $fecha_ingreso = $row['fecha_ingreso'];
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
    <title>Modificar Póliza</title>
</head>
<body>

<div>
                  <form action="" method="post">
                        <label class="clabel">INGRESE ID DE POLIZA</label>
                        <input type="number" name="clave" required />
                        <input class="button" name="login" type="submit" value="VAMOS" />
                  </form>
                </div>

        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>EDITAR POLIZA</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraModPoli.php">
                        <div class="input_field select_option" >
                                <select name="ncb" id="ncb" onchange="cambioOpciones();">
                                <option value="0">SELECCIONA EL NUMERO DE CUENTA</option>
                                <?php //CONSULTA PARA TRAER LOS DATOS DE LA TABLA NUMERO DE CUENTA DE BENEFICIARIO
                                    $query = $con -> query ("SELECT * FROM ncb");
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
                                    $query = $con -> query ("SELECT * FROM transaccion WHERE idt = 1 OR idt = 2");
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
                            
                            <label class="clabel">REFERENCIA NUMERICA / N° CHEQUE </label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="referencia_num" id="REFERENCIA_NUM" value="<?php echo $ref_num; ?>" required />
                            </div>
                            <label class="clabel">FECHA DE OPERACION</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/calendar.png" width="26px" ></i></span>
                                <input type="text" name="fecha_env" id="FECHA_ENV" value="<?php echo $fecha_envio; ?>" required />
                            </div>
                            <label class="clabel">PROVEEDOR / PERSONAS</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/right-alignment.png" width="26px" ></i></span>
                                <input type="text" name="proveedor" id="PROVEEDOR" value="<?php echo $proveedor; ?>"  required />
                            </div>
                            <label class="clabel">MOTIVO</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/right-alignment.png" width="26px" ></i></span>
                                <input type="text" name="motivo" id="MOTIVO" value="<?php echo $motivo; ?>"  required />
                            </div>
                            <label class="clabel">FECHA DE INGRESO</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/right-alignment.png" width="26px" ></i></span>
                                <input type="text" name="feching" id="FECHAING" value="<?php echo $fecha_ingreso; ?>"  required />
                            </div>
                                <input type="hidden" name="idpoli" value="<?php echo $idPoliza; ?>" />
                                <input type="hidden" name="idu" value="<?php echo $_SESSION['iduser']; ?>" />
                                <input class="button" type="submit" value="GUARDAR" onclick="pregunta()"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="mpolizas.php" class="btn btnn">REGRESAR</a>
        </div>
        
        <script src="js/nuevo.js"></script>
        <script src="js/funciones.js"></script>
</body>
</html>
<?php
}
    }
?>