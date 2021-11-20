<?php  
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

   
  <div class="container container-usuarios" id="modificar-eliminar" >
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 500px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion usuario</h4>" ?></div>
					<div class="panel panel-body">
					
						<form class="cont-form" id="frmUser">
							<label>Id</label>                          
							    <input  type="text" readonly class="form-control input-sm" name="idUsuario" value="<?php echo $ver[0] ?>">
								<?php if($accion=='Modificar'){  echo "
							<label>Nombre</label>
			                    <input type='text'class='form-control input-sm' name='nombre' value='$ver[1]'>
							<label>email</label>
			                    <input type='email'class='form-control input-sm' name='email' value='$ver[2]'>
							<label>Fecha</fecha>
							    <input type='date' class='form-control input-sm' name='fecha' value='$ver[3]'>
							<label>Enabled</label>
							<div class=enabled>
							    <label for='$ver[4]'>Registrado</label>
							    <input type='radio' name='enabled' value='$ver[4]'>							   
							</div>	
 
								";} else{ echo "
							<label>Nombre</label>
								<input readonly type='text'class='form-control input-sm' name='nombre' value='$ver[1]' >
							<label>email</label>
								<input readonly type='email'class='form-control input-sm' name='email' value='$ver[2]' >
							<label>Fecha</fecha>
								<input readonly type='date' class='form-control input-sm' name='fecha' value='$ver[3]'>
							<label>Enabled</label>
								<intput readonly type='radio' class='form-control input-sm' name='enabled' value='$ver[4]'>	
							";}?>     
			
						
			<?php  if($accion == 'Modificar'){ echo"
			<span class='btn btn-primary btn-sm btn-user' id='confCambiosUser'>Modificar</span> 
			";}else{ echo "
			<span class='btn btn-primary btn-sm btn-user' id='confEliminarUser'>Eliminar</span> 
			";}?>
              <br>
              <br>
							<span class="btn btn-danger btn-sm btn-accion"  onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>  
                                          
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



<!-- BLOQUE CON EL FORMULARIO CREAR  -->

<!-- <div class="container" id="crearForm" >
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 200px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion articulo </h4>" ?></div>
					<div class="panel panel-body">
					
						<form class="cont-form" id="frmUserCrear">
              <label>Categoria</label>
			  <select name="categoriaCrear">         
			  <?php while($allOptionscrear=mysqli_fetch_row(($result2)))
              echo "<option value='$allOptionscrear[1]'> $allOptionscrear[0] </option>" ?>
              </select>
              <br>
              <label>Nombre</label>
							<input type="text"class="form-control input-sm" name="nombreCrear" id="nombreCrear" >
              <label>Coste</label>
							<input type="text"class="form-control input-sm" name="costeCrear" id="costeCrear" >
              <label>Precio</label>
							<input type="text"class="form-control input-sm" name="precioCrear" id="precioCrear" >
                     <br>     
							<span class="btn btn-primary btn-sm btn-accion" id="confCrearUser">Crear</span>  
              <br>
              <br>
							<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>  
                                          
						</form>
						<span id="resultado3"></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>  -->
    <script  src="js/funciones.js"></script>
    <script src="js/enviosPOST.js"></script>
	

	<!-- VENTANA MENSAGE OPERACION REALIZADA-->

	<div id="container-mensage" class="container-mensage" style="display: none;">
		<h3 style="text-align: center;">Operación realizada con exito!</h3>
		<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>
	</div>    

<!-- MOSTRAR FORMULARIO A O B DEPENDIENDO DE LA ACCION A REALIZAR(CREAR-MODIF-ELIMINAR)-->
<script>
      var modificarEliminar =document.getElementById('modificar-eliminar')
      var crear =document.getElementById('crearForm')
      var accion="<?php echo $accion; ?>"
      if(('Modificar'== accion)||('Eliminar' == accion)){
        modificarEliminar.style.display='block';
      }else{
        modificarEliminar.style.display='none';
      }
      if('Crear'== accion){
        crear.style.display='block';
      }else{
      crear.style.display='none';
      }
</script>

</body>
</html>