<?php  

session_start();

//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("location:index.php");
}
require_once "conections/BaseDatos.php";
$objet=new usuarios();
$super=($objet->superAdmin());
while ($superAdmin=mysqli_fetch_row($super)){
	if($superAdmin[0] == $_SESSION['username']){
	}
	else{
		header('Location:index.php');
	}
}


// CONEXION PARA OBETENER LOS REGISTROS DEL PRODUCTO A MODIFICAR
require_once "conections/BaseDatos.php";

// VARIABLE PASADA POR URL CON ID DEL PRODUCTO
if(isset($_GET['upd'])) 
$userId=$_GET['upd'];

// VARIABLE PASADA POR URL CON LA ACCION CREAR-MODIF-ELIMINAR
if(isset($_GET['accion']))
$accion=$_GET['accion'];

$obje=new usuarios();
$result=$obje->mostrarUsuarioModificarEliminar($userId);
?>



<!-- CODIGO HTML -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">

	<script type="text/javascript" src="libraries/jquery-3.2.1.min.js"></script>
        <title>Document</title>
</head>
<body>

<!-- BLOQUE CON EL FORMULARIO MODIFICAR - ELIMINAR -->
<?php   
   while ($ver=mysqli_fetch_row($result)):
   ?>

   
<?php  
   if(isset($_GET['accion'])) if(($_GET['accion']=='modificado')||($_GET['accion']=='eliminado')
   ||($_GET['accion']=='Crear')||($_GET['accion']=='creado')){ echo"
  <div class='container' style='display:none' >
  ";}else{ echo"
	<div class='container'>
  ";}?>
  

		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 500px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion usuario</h4>" ?></div>
					<div class="panel panel-body">
					        <?php if($accion=='Modificar'): ?>
						<form class="cont-form" method="post" action="EnviosPOST/modificarUsuario.php">
							<?php endif ?>
							<?php if($accion=='Eliminar'): ?>
								<form class="cont-form" method="post" action="EnviosPOST/eliminarUsuario.php">
								<?php endif ?>

							<label>Id</label>                          
							    <input  type="text" readonly class="form-control input-sm" name="idUsuario" value="<?php echo $ver[0] ?>">
								<?php if($accion=='Modificar'){  echo "
							<label>Nombre</label>
			                    <input type='text'class='form-control input-sm' name='nombre' value='$ver[2]' required>
							<label>email</label>
			                    <input type='email'class='form-control input-sm' name='email' value='$ver[1]' required>
							<label>Último acceso</label>
							    <input type='date' class='form-control input-sm' name='fecha' value='$ver[3]' required>					
 
								";} else{ echo "
							<label>Nombre</label>
								<input readonly type='text'class='form-control input-sm' name='nombre' value='$ver[2]' >
							<label>email</label>
								<input readonly type='email'class='form-control input-sm' name='email' value='$ver[1]' >
							<label>Último acceso</label>
								<input readonly type='text' class='form-control input-sm' name='fecha' value='$ver[3]'>
														
							";}?>   
							<?php  
							if($accion=='Modificar'):?>
				            <label>Enabled</label>
							<div class='enabled'>
								
							    <label style="margin-top: 0;" for='$ver[4]'>Registrado</label>
							    <input style="width: 50px;" type='radio' name='enabled' value='0'  <?php if($ver[4]==0) echo "checked"; ?>>		
												   
							</div>	
							
							<div class='enabled'>
							    <label style="margin-top: 0;" for='$ver[4]'>Autorizado</label>
							    <input style="width: 50px;" type='radio' name='enabled' value='1'  <?php if($ver[4]==1) echo "checked";?>>						   
							</div>	
							<?php endif ?>
						
							<!-- eliminar -->
							<?php  
							if($accion=='Eliminar'):?>
							 <label>Enabled</label>
							 <?php if($ver[4]==0){ echo "
							<div class='enabled'>								
							    <label style='margin-top: 0'>Registrado</label>
							    <input style='width: 50px;' type='radio' name='enabled'checked>												   
                            </div>			
							 ";}else{echo"
									<div class='enabled'>								
										<label style='margin-top: 0'>Autorizado</label>
										<input style='width: 50px;' type='radio' name='enabled'checked>												   
									</div>		
							 ";}?>
				<?php endif ?>
						
			<?php  if($accion == 'Modificar'){ echo"
			<button type='submit' class='btn btn-primary btn-sm btn-user'>Modificar</button> 
			";}else{ echo "
			<button type='submit' class='btn btn-primary btn-sm btn-user'>Eliminar</button> 
			";}?>
              <br>
              <br>
							<span class="btn btn-danger btn-sm btn-accion"  onclick="location.href='views/usuarios.php'"><h5>Volver</h5></span>  
                                          
						</form>
						<span id="resultado"></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>


<?php endwhile 
?>

<!-- BLOQUE CON EL FORMULARIO DE CREAR USUARIO -->

 <?php  
 if(isset($_GET['accion'])) if($_GET['accion']!='Crear'){echo"
   <div class='container' style='display:none'>
   ";}else{ echo"
	 <div class='container'>
   ";}?>
  

		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 500px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion usuario</h4>" ?></div>
					<div class="panel panel-body">
					        <?php if($accion=='Crear'): ?>
						<form class="cont-form" method="post" action="EnviosPOST/crearUsuario.php">
							<?php endif ?>
							
							<label>ID</label>
			                    <input type='text'class='form-control input-sm' name='idUsuario' required>
							<label>Nombre</label>
			                    <input type='text'class='form-control input-sm' name='nombre' required>
							<label>email</label>
			                    <input type='email'class='form-control input-sm' name='email' required>
							<label>Último acceso</label>
							    <input type='date' class='form-control input-sm' name='fecha' required>					

				            <label>Enabled</label>
							<div class='enabled'>								
							    <label style="margin-top: 0;" for='$ver[4]'>Registrado</label>
							    <input style="width: 50px;" type='radio' name='enabled' value='0'>		
							</div>	
							
							<div class='enabled'>
							    <label style="margin-top: 0;" for='$ver[4]'>Autorizado</label>
							    <input style="width: 50px;" type='radio' name='enabled' value='1'>						   
							</div>	
						
	
			                  <button type='submit' class='btn btn-primary btn-sm btn-user'>Crear</button> 

		
              <br>
              <br>
							<span class="btn btn-danger btn-sm btn-accion"  onclick="location.href='views/usuarios.php'"><h5>Volver</h5></span>  
                                          
						</form>
					
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
	
	<!-- VENTANA MENSAGE OPERACION REALIZADA-->

	<?php if(isset($_GET['accion'])) if(($_GET['accion']=='modificado')||($_GET['accion']=='eliminado')||($_GET['accion']=='creado')): ?>
	<div class="container-mensage">
		<h3 style="text-align: center;">Operación realizada con exito!</h3>
		<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/usuarios.php'"><?php echo "<h5> Volver</h5>" ?></span>
	</div>   
	<?php 
	endif;
	?>  

	

</body>
</html>