<?php
session_start();
$welcome=$_SESSION['username'];
// $rol=$_SESSION['rol'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">

    <script src="js/funciones.js"></script>
    <script src="libraries/jquery-3.2.1.min.js"></script>
    <title>Login User</title>
</head>
<body>
<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Gestion de Comercio</div>
					<div class="panel panel-body">					
						<form id="frmLogin">
                            <span id="welcome"><?php echo "Bienvenido $welcome" ?> <a href="iniciandoSesion.php">continuar</a></span>                         
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>   
    
</body>
</html>