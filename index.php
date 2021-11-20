
<?php 
if(isset($_GET['usuario']))
$nombreUsuario=$_GET['usuario'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css"> 
    <link rel="stylesheet" href="css/estilos.css">   
    <title>Login User</title>
</head>
<body>
<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div style="height: 200px" class="panel panel-primary">
					<div class="panel panel-heading">Gestión de Comercio</div>
					<div class="panel panel-body">
					
						<form method="post" action="login.php">
							<label>Usuario</label>                          
							<input type="text" class="form-control input-sm" name="usuario" required>
							<label style="margin-top: 5px;">Email</label>
							<input type="email"class="form-control input-sm" name="email" required>
                            <br>                           
							<button type="submit" class="btn btn-primary btn-sm btn-entrar">Entrar</button>  
                            <?php if(isset($_GET['conectado'])){ if($_GET['conectado']==1){echo"
                            <div class='contSA'> <h4>Bienvenido $nombreUsuario</h4></div>                          
                            ";}else{echo"
                            <div class='contSA'> <h4>Ingrese un usuario valido</h4></div>    
                            ";}}?>
                            <?php if(isset($_GET['conectado']))if($_GET['conectado']==1):     ?>
                            <button type='button' onclick="location.href='acceso.php'" class='btn btn-danger btn-sm botonOculto <?php echo "botonVisto";?>'>Continuar</button>
                            <?php endif ?>
                            </form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>    
                                       
    
</body>

<!-- <script>
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
            var saludo = document.getElementById('usuario').value;
            document.getElementById('saludo').innerHTML='Bienvenido ' + saludo;
            document.getElementById('adelante').style.display='block'          
        }
        else{
            alert("No se ha podido acceder")
        }
    }
   
});

});
    })
</script>  -->
</html>