<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
        
        if ($_SESSION["ROL"] == 1)
        {

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
                <title>Editar Beneficiario</title>
            </head>
            <body>
            <?php
                //declaramos variables para no generar errores al mostrar por 1primera vez
                    $idn = "";
                    $nombre = "";
                    $apellidos = "";
                    $banco = "";
                    $ncuenta = "";
                    $ntransferencia = "";;   

            if(isset($_POST['clave']))//si existe algun dato a buscar
            {
                $answer=$_POST['clave'];//seasigna      
                $sql = "SELECT * FROM ncb WHERE idn = '$answer'";//se busca si existe
                $query = $con->query($sql);
                $numrows=mysqli_num_rows($query);
                if($numrows == 0){
                    echo'<script type="text/javascript">
                            alert("Error, verificar el id del Beneficiario");
                           </script>';
                    ?>
                    <script>
                      window.history.back(); 
                    </script>
                    <?php
                }
                else
                {
                  while($row=mysqli_fetch_assoc($query))//si existe se declaran en la variables de abajo y se muestran en el html
                  {
                    $idn = $row['idn'];
                    $nombre = $row['nombre'];
                    $apellidos = $row['apellidos'];
                    $banco = $row['banco'];
                    $ncuenta = $row['ncuenta'];
                    $ntransferencia = $row['ntransferencia'];   
                  }
                }
            }
                
                ?>
                <div>
                  <form action="" method="post">
                        <label class="clabel">INGRESE ID DE USUARIO</label>
                        <input type="number" name="clave" required />
                        <input class="button" name="login" type="submit" value="VAMOS" />
                  </form>
                </div>
                    <div class="form_wrapper">
                        <div class="form_container">
                            <div class="title_container">
                            <h2>EDITAR BENEFICIARIO</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="">
                                    <form method="post" action="includes/registraModNCB.php">
                                        <div class="row clearfix">
                                        
                                            <div class="col_half">
                                                <label class="clabel">Nombre(s)</label>
                                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px"></i></span>
                                                <input type="text" name="nombre" value="<?php echo $nombre; ?>" />
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <label class="clabel">Apellidos</label>
                                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/man.png" width="26px"></i></span>
                                                <input type="text" name="apellido" value="<?php echo $apellidos; ?>" required  />
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <label class="clabel">Banco * Terminación</label>
                                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/bank.png" width="26px"></i></span>
                                                <input type="text" name="banco" value="<?php echo $banco; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <label class="clabel">Número de Cuenta</label>
                                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/card.png" width="26px"></i></span>
                                                <input type="text" name="numcuenta" value="<?php echo $ncuenta; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <label class="clabel">Transferencia</label>
                                                <div class="input_field"> <span><i aria-hidden="true"><img src="icons/transaction.png" width="26px"></i></span>
                                                <input type="text" name="transferencia" value="<?php echo $ntransferencia; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                            <input class="button" type="submit" value="VAMOS" onclick="pregunta()"/>
                                            <input type="hidden" name="idu" value="<?php echo $_SESSION['iduser']; ?>" />
                                            <input type="hidden" name="idn" value="<?php echo $idn; ?>" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <a href="editar.php" class="btn btnn">REGRESAR</a>
                    </div>
                    <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
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