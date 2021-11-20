<?php  

session_start();

//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("location:index.php");
}


// VARIABLE PASADA POR URL CON ID DEL PRODUCTO
if(isset($_GET['upd'])) 
$idArticulo=$_GET['upd'];

// VARIABLE PASADA POR URL CON LA ACCION CREAR-MODIF-ELIMINAR
if(isset($_GET['accion']))
$accion=$_GET['accion'];

// CONEXION PARA OBETENER LOS REGISTROS DEL PRODUCTO A MODIFICAR
require_once "conections/BaseDatos.php";
$obje=new Productos();
$result=$obje->mostrarProductoModificarEliminar($idArticulo);

//CONEXION PARA OBTENER LOS OPTIONS DEL SELECT EN AMBOS FORMULARIOS

$result1=($obje->mostrarOptionsSelect());
$result2=($obje->mostrarOptionsSelect());
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
   <!-- pone el formulario en display none si se ha realizado la operacion correctamente-->
 <?php  
   if(isset($_GET['accion'])) if(($_GET['accion']=='modificado')||($_GET['accion']=='eliminado')
   ||($_GET['accion']=='Crear')||($_GET['accion']=='creado')){ echo"
  <div class='container' style='display:none' >
  ";}else{ echo"
	<div class='container'>
  ";}?>

  <!-- formulario usando boostrap -->
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 200px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion articulo </h4>" ?></div>
					<div class="panel panel-body">
					<?php  if($accion == 'Modificar'){ echo"
			       	<form class='cont-form' method='post' action='EnviosPOST/modificarArticulo.php'>
			       ";}else{ echo "
					<form class='cont-form' method='post' action='EnviosPOST/eliminarArticulo.php'> 
			        ";}?>
				<label>Id</label>                          
				<input  type="text" readonly class="form-control input-sm" name="idProducto" id="idProducto" value="<?php echo $ver[2] ?>">
				<label>Categoria</label>
				<?php if($_GET['accion']=='Eliminar'): ?>			
			  <input readonly type="text" class="form-control input-sm" name="categori" value='<?php echo" $ver[1]";?>' >
			  <?php endif?>

			  <!-- Select con las options para modificar la categoria del producto -->
			  <?php if($_GET['accion']=='Modificar'): ?>	
			   <select name='categoria'>         
	            <?php
				while($allOptions=mysqli_fetch_row(($result1))){
					if($ver[1]==$allOptions[0]){
              echo "<option selected value='$allOptions[1]'>$allOptions[0]</option>";}
			  else{
			echo "<option value='$allOptions[1]'>$allOptions[0]</option>";
			  }}?>
			  
              </select>	
			  <?php endif ?>
			  <!-- Corregir el espacio que deja el select -->
			  <?php  if($accion=='Modificar'){
				  echo "<p></p>";
			  }
			  ?>	 
			  <?php if($accion=='Modificar'){  echo "
              <label style='margin-top: 10px;'>Nombre</label>
							<input type='text'class='form-control input-sm' name='nombre' id='nombre' value='$ver[3]' required>
              <label>Coste</label>
							<input type='text'class='form-control input-sm' name='coste' id='coste' value='$ver[4]' required>
              <label>Precio</label>
							<input type='text' class='form-control input-sm' name='precio' id='precio' value='$ver[5]' required>                 
							<br>
							";} else{ echo "
			<label style='margin-top: 10px;'>Nombre</label>
							<input readonly type='text'class='form-control input-sm' name='nombre' id='nombre' value=' $ver[3]' >
			<label>Coste</label>
							<input readonly type='text'class='form-control input-sm' name='coste' id='coste' value='$ver[4]' >
			<label>Precio</label>
							<input readonly type='text' class='form-control input-sm' name='precio' id='precio' value='$ver[5]'>                 
							<br>
							";}?>     
			<?php  if($accion == 'Modificar'){ echo"
			<button type='submit' class='btn btn-primary btn-sm btn-accion'>Modificar</button> 
			";}else{ echo "
			<button type='submit' class='btn btn-primary btn-sm btn-accion'>Eliminar</button> 
			";}?>
              <br>
              <br>
							<span class="btn btn-danger btn-sm btn-accion"  onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>  
                                          
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
<?php endwhile 
?>



<!-- BLOQUE CON EL FORMULARIO CREAR -->
<?php  
if(isset($_GET['accion'])) if($accion!='Crear'){echo"
  <div class='container' style='display:none'>
  ";}else{ echo"
	<div class='container'>
  ";}?>
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 200px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion articulo </h4>" ?></div>
					<div class="panel panel-body">
					
						<form class="cont-form" method="post" action="EnviosPOST/crearArticulo.php">
              <label>Categoria</label>
			  <select name="categoria" required>         
			  <?php while($allOptionscrear=mysqli_fetch_row(($result2)))
              echo "<option value='$allOptionscrear[1]'> $allOptionscrear[0] </option>" ?>
              </select>
              <br>
			  <label>ID</label>
							<input type="text"class="form-control input-sm" name="idProducto" required>
              <label>Nombre</label>
							<input type="text"class="form-control input-sm" name="nombre" required>
              <label>Coste</label>
							<input type="text"class="form-control input-sm" name="coste" required>
              <label>Precio</label>
							<input type="text"class="form-control input-sm" name="precio" required>
                     <br>     
					       
							<button type="submit" class="btn btn-primary btn-sm btn-accion">Crear</button>  
              <br>
              <br>
							<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>  
                                          
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
		<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>
	</div>   
	<?php 
	endif;
	?>  


</body>
</html>