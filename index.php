<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="libraries/alertifyjs/css/alertify.css">
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
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Password</label>
							<input type="email"class="form-control input-sm" name="email" id="email" >
							<p></p>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
                            <!-- <h2><?php   ?></h2> -->
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>   
    
</body>

<script>
    $(document).ready(function(){

        $('#entrarSistema').click(function(){

            vacios=validarFormVacio('frmLogin');

if(vacios > 0){
    alert("Debes llenar todos los campos!!");
    return false;
}


datos=$('#frmLogin').serialize();

$.ajax({
    type:"POST",
    data:datos,
    url:"login.php",
    success:function(r){

        if(r==1){
            window.location="acceso.php"
        }
        else{
            alert("No se ha podido acceder")
        }
    }
});
});
    })
</script>
</html>