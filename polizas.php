<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {

        if ($_SESSION['iduser'] != '11')
        {
            header("location:index.php");
        }
        else{

    include "includes/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/register.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pólizas</title>
</head>
<body>

        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                <h2>AGREGAR PÓLIZA</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form method="post" action="includes/registraPoliza.php">
                        <div class="input_field select_option" >
                                <select name="ncb" id="ncb" onchange="cambioOpciones();">
                                <option value="0">SELECCIONA EL NUMERO DE CUENTA</option>
                                <?php 
                                    $query = $con -> query ("SELECT * FROM ncb");
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
                                    $query = $con -> query ("SELECT * FROM transaccion WHERE idt = 1 OR idt = 2");
                                    while ($r = mysqli_fetch_array($query)){
                                        echo ' <option value="'.$r['idt'].'">'.$r['tipo'].'</option>';
                                    }
                                ?>
                                </select>
                                <div class="select_arrow"></div>
                            </div>

                            <label class="clabel">MONTO</label>
                            <div class="input_field"> <span><i aria-hidden="true" > <img src="icons/cash.png" width="26px" > </i></span>
                                <input type="number" name="monto" id="MONTO" step="any" required />
                            </div>
                            
                            <label class="clabel">REFERENCIA NUMERICA / N° CHEQUE </label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/asterisk.png" width="26px" ></i></span>
                                <input type="number" name="referencia_num" id="REFERENCIA_NUM" required />
                            </div>
                            <label class="clabel">FECHA DE OPERACION</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/calendar.png" width="26px" ></i></span>
                                <input type="date" name="fecha_env" id="FECHA_ENV" required />
                            </div>
                            <label class="clabel">PROVEEDOR / PERSONAS</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px" ></i></span>
                                <input type="text" name="proveedor" id="PROVEEDOR" required />
                            </div>
                            <label class="clabel">MOTIVO</label>
                            <div class="input_field"> <span><i aria-hidden="true"><img src="icons/invoice.png" width="26px" ></i></span>
                                <input type="text" name="motivo" id="MOTIVO" required />
                            </div>

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