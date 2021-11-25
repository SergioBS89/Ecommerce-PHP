<!-- CODIGO PHP -->
<?php  
session_start();

//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("location:index.php");
}
// Valido que el usuario tiene el rol superadmin
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

//Obtenemos el valor del id de usuario
if(isset($_GET['upd'])) 
$userId=$_GET['upd'];

//obtenemos el valor de accion, para crear, modificar o eliminar
if(isset($_GET['accion']))
$accion=$_GET['accion'];

//llamamos a la funcion para que devuelva los datos del usuario
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
        <title>Formulario usuarios</title>
    </head>
	<!--Formulario que aparece cuando la accion es 'Modificar' o 'Eliminar'-->
    <body>    
        <!--Mandamos imprimir el registro a modificar o eliminar-->
        <?php   
        while ($ver=mysqli_fetch_row($result)):
        ?>  
		 <!--Se pone el formulario en display 'none', si se ha realizado la gestión correctamente-->    
        <?php  
		 //si al obtener la variable acción, esta tiene los siguientes valores, el contenedor desaparece
        if(isset($_GET['accion'])) if(($_GET['accion']=='modificado')||($_GET['accion']=='eliminado')
        ||($_GET['accion']=='Crear')||($_GET['accion']=='creado')){ 
		echo"
        <div class='container' style='display:none' >
        ";}else{ //de lo contrario, se muestra
		echo"
      	<div class='container'>
        ";}?>
        
    
    		<div class="row">
    			<div class="col-lg-4"></div>
    			<div class="col-lg-4">
    				<div style="height: 500px" class="panel panel-primary">
					     <!--Imprimo la acción que se realiza para el titulo del formuario  -->
    					<div class="panel panel-heading form-name-position"><?php echo "<h4> $accion usuario</h4>" ?></div>
    					<div class="panel panel-body">
                            <!--la etiqueta form tendra un action que manda los datos a modificarUsuario.php-->
    					    <?php if($accion=='Modificar'): ?>
    						<form class="cont-form" method="post" action="EnviosPOST/modificarUsuario.php">
    						<?php endif ?>
							<!-- la etiqueta form tendra un action que manda los datos a eliminarUsuario.php -->
    						<?php if($accion=='Eliminar'): ?>
    						<form class="cont-form" method="post" action="EnviosPOST/eliminarUsuario.php">
    						<?php endif ?>
    
    							<label>Id</label>                          
    						    <input  type="text" readonly class="form-control input-sm" name="idUsuario" value="<?php echo $ver[0] ?>">
								<!-- Si accion es modificar se imprimen las siguientes etiquetas -->
    						    <?php if($accion=='Modificar'){  echo "
    							<label>Nombre</label>
    			                <input type='text'class='form-control input-sm' name='nombre' value='$ver[2]' required>
    							<label>email</label>
    			                <input type='email'class='form-control input-sm' name='email' value='$ver[1]' required>
    							<label>Último acceso</label>
    							<input type='date' class='form-control input-sm' name='fecha' value='$ver[3]' required>					
                                ";} else{ //De lo contrario, se imprimen estas otras etiquetas
								echo "
    							<label>Nombre</label>
    							<input readonly type='text'class='form-control input-sm' name='nombre' value='$ver[2]' >
    							<label>email</label>
    							<input readonly type='email'class='form-control input-sm' name='email' value='$ver[1]' >
    							<label>Último acceso</label>
    							<input readonly type='text' class='form-control input-sm' name='fecha' value='$ver[3]'>    														
    							";}?>   
								<!-- Si accion es modificar, se imprime el siguiente bloque -->
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
    							<!--Si accion es eliminar, se imprime este bloque, donde se imprime solamente el rol de cada usuario-->
    							<?php  
    							if($accion=='Eliminar'):?>
    							<label>Enabled</label>
    							<?php if($ver[4]==0){ 
								echo"
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
    						    <!-- Se crean los botones modificar o eliminar dependiendo de la accion -->
    			                <?php  
								if($accion == 'Modificar'){ 
								echo"
    			                <button type='submit' class='btn btn-primary btn-sm btn-user'>Modificar</button> 
    			                ";}else{ 
								echo"
    			                <button type='submit' class='btn btn-primary btn-sm btn-user'>Eliminar</button> 
    			                ";}?>
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
        <?php endwhile ?>
    
        <!--Formulario que aparece cuando la accion es 'Crear'-->    
        <?php  //Si accion es diferente a crear, desaparece el formulario
        if(isset($_GET['accion'])) if($_GET['accion']!='Crear'){
		echo"
        <div class='container' style='display:none'>
        ";}else{ //de lo contrario, imprime el formulario
		echo"
    	<div class='container'>
        ";}?>                
        	<div class="row">
        		<div class="col-lg-4"></div>
        		<div class="col-lg-4">
        			<div style="height: 500px" class="panel panel-primary">
					    <!--Imprimo la acción que se realiza para el titulo del formuario  -->
        				<div class="panel panel-heading form-name-position"><?php echo "<h4> $accion usuario</h4>" ?></div>
        				<div class="panel panel-body">
							<!--Se crea el formulario con el action que manda los datos a crearUsuario.php -->
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
    	
    	<!--Mensaje de confirmacion-->    

    	<?php //Si se cumple la condicion, aparece el mensaje operacion realizada
		if(isset($_GET['accion'])) if(($_GET['accion']=='modificado')||($_GET['accion']=='eliminado')||($_GET['accion']=='creado')): ?>
    	<div class="container-mensage">
    		<h3 style="text-align: center;">Operación realizada con exito!</h3>
    		<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/usuarios.php'"><?php echo "<h5> Volver</h5>" ?></span>
    	</div>   
    	<?php endif;?>      
    </body>
</html>