<?php  

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

//CONEXION PARA OBTENER LOS OPTIONS DEL SELECT

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

   
  <div class="container" id="modificar-eliminar" >
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 200px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion articulo </h4>" ?></div>
					<div class="panel panel-body">
					
						<form class="cont-form" id="frmProducts">
							<label>Id</label>                          
							<input  type="text" readonly class="form-control input-sm" name="idProducto" id="idProducto" value="<?php echo $ver[2] ?>">
							<label>Categoria</label>
							<!-- input donde se muestra la categoria del producto en la opcion eliminar-->
			  <input style="display: none;" readonly type="text"class="form-control input-sm" name="categori" id="categori" value="<?php echo $ver[0] ?>" >
			  <!-- Select con las options para modificar la categoria del producto -->
			   <select id="selectEliminar" name='categoria' id='categoria'>         
	            <?php
				while($allOptions=mysqli_fetch_row(($result1)))
              echo "<option value='$allOptions[1]'> $allOptions[0] </option>" ?>
              </select>	
			  <!-- Corregir el espacio que deja el select -->
			  <?php  if($accion=='Modificar'){
				  echo "<p></p>";
			  }
			  ?>	 
			  <?php if($accion=='Modificar'){  echo "
              <label style='margin-top: 10px;'>Nombre</label>
							<input type='text'class='form-control input-sm' name='nombre' id='nombre' value='$ver[3]'>
              <label>Coste</label>
							<input type='email'class='form-control input-sm' name='coste' id='coste' value='$ver[4]'>
              <label>Precio</label>
							<input type='email' class='form-control input-sm' name='precio' id='precio' value='$ver[5]'>                 
							<br>
							";} else{ echo "
			<label style='margin-top: 10px;'>Nombre</label>
							<input readonly type='text'class='form-control input-sm' name='nombre' id='nombre' value=' $ver[3]' >
			<label>Coste</label>
							<input readonly type='email'class='form-control input-sm' name='coste' id='coste' value='$ver[4]' >
			<label>Precio</label>
							<input readonly type='email' class='form-control input-sm' name='precio' id='precio' value='$ver[5]'>                 
							<br>
							";}?>     
			<?php  if($accion == 'Modificar'){ echo"
			<span class='btn btn-primary btn-sm btn-accion' id='confirmarCambios'>Modificar</span> 
			";}else{ echo "
			<span class='btn btn-primary btn-sm btn-accion' id='confirmarEliminar'>Eliminar</span> 
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

<div class="container" id="crearForm" >
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div style="height: 200px" class="panel panel-primary">
					<div class="panel panel-heading form-name-products"><?php echo "<h4> $accion articulo </h4>" ?></div>
					<div class="panel panel-body">
					
						<form class="cont-form" id="frmProductsCrear">
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
							<span class="btn btn-primary btn-sm btn-accion" id="confirmarCambiosCrear"><?php echo "<h5> $accion</h5>" ?></span>  
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
	</div> 

	

	<!-- VENTANA MENSAGE OPERACION REALIZADA-->

	<div id="container-mensage" class="container-mensage" style="display: none;">
		<h3 style="text-align: center;">Operación realizada con exito!</h3>
		<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>
	</div>    



<!-- MOSTRAR MAS O MENOS CONTENIDO DEPENDEIENDO DE LA ACCION A REALIZAR-->
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

	// ELIMINAR SELECT HTML DE CATEGORIA
	var sectionCateg =document.getElementById('selectEliminar')
	var mostrarInputCategoria = document.getElementById('categoria')
	if('Eliminar'==accion){
		sectionCateg.style.display='none'
		mostrarInputCategoria.style.display='block'
	}
    </script>
	<script  src="js/funciones.js"></script>
	<script  src="js/enviosPOST.js"></script>
</body>
</html>