<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
    include "includes/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/register.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <title>Agregar Deposito</title>
</head>
<body>

        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>NUEVO DEPOSITO</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registra.php">
                        <div class="input_field select_option" >
                                <select name="ncb" id="ncb" onchange="cambioOpciones();">
                                <option value="0">SELECCIONA EL NUMERO DE CUENTA</option>
                                <?php 
                                    $query = $con -> query ("SELECT * FROM ncb LIMIT 4");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['idn'].'">'.$r['banco'].'</option>';
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
                                <?php //consulta para traer los tipos de pago
                                    $query = $con -> query ("SELECT * FROM transaccion");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['idt'].'">'.$r['tipo'].'</option>';
                                    }
                                ?>
                                </select>
                                <div class="select_arrow"></div>
                            </div>
                            
                            
                            <label class="clabel">MONTO</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field"> <span><i aria-hidden="true" > <img src="icons/cash.png" width="26px" > </i></span>
                                <input type="number" name="monto" id="MONTO" step="any" required /> 
                            </div>
                            
                            
                            <label class="clabel">REFERENCIA NUMERICA</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="referencia_num" id="REFERENCIA_NUM" required />
                            </div>

                            
                            <label class="clabel">CLAVE DE RASTREO</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="clave_rastreo" id="CLAVE_RASTREO" required />
                            </div>

                            
                            <label class="clabel">FECHA DE OPERACION</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/calendar.png" width="26px" ></i></span>
                                <input type="date" name="fecha_env" id="FECHA_ENV" required />
                            </div>
                            <!--********************************************-->
                            
                            <label class="clabel">CLIENTE</label>
                            <div class="input_field">
                            <span><i aria-hidden="true"><img src="icons/man.png" width="26px" ></i></span>
                                <input type="text" name="cliente" id="CLIENTE" list="client">
                                    <datalist id="client">
                                    <?php 
                                    //hacemos consulta a bancos para traer su nombre y cargarlos en un datalist
                                    $query = $con -> query ("SELECT * FROM clientes");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['nombre'].' '.$r['apellidos'].'">';
                                       // echo ' <option value="'.$r[idc].'" label=" '.$r[nombre].' '.$r[apellidos].'">';
                                       // echo '<option value="1" label="color azul">';
                                   }
                                ?>
                                    </datalist>    
                            </div>

                            
                            <label class="clabel">BANCO EMISOR</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field">
                            <span><i aria-hidden="true"><img src="icons/bank.png" width="26px" ></i></span>
                                <input type="text" name="example" list="exampleList">
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
                            <!--*******************************-->

                            
                            <label class="clabel">FACTURA</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/invoice.png" width="26px" ></i></span>
                                <input type="text" name="factura" id="FACTURA" required />
                            </div>

                            
                            <label class="clabel">FOLIO REMISION</label><span style="align-items:center;"><i aria-hidden="true" > <img src="icons/question.png" width="16px" > </i></span>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="text" name="folio_remision" id="FOLIO_REMISION" required />
                            </div>

                            <div class="input_field select_option" >
                                <select name="sucursal" id="sucursal">
                                <option value="0">SELECCIONA LA SUCURSAL</option>
                                <?php 
                                    $query = $con -> query ("SELECT * FROM sucursal");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['nombre'].'">'.$r['nombre'].'</option>';
                                    }
                                ?>
                                </select>
                                <div class="select_arrow"></div>
                            </div>

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
?>