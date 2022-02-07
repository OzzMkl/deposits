<?php 
    session_start();
    if(!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="icons/otilio.ico" type="image/x-icon">
    <title>Principal</title>
</head>
<body>


    
    <div class="container">
        <a class="btn btnn" href="pdf.php">consulta1</a>
        <a class="btn btnn" href="#">consulta2</a>
        <a class="btn btnn">consulta3</a>
    </div>
    <div class="container">
<a href="index.php" class="btn btnn">REGRESAR</a>
</div>
    </body>
    <footer>
    </footer>
</html>
<?php
}
?>