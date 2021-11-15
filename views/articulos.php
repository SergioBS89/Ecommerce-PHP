<?php

session_start();
$rol=null;
$roles =null;

// VALIDACION DE USUARIO
if($_SESSION['username']){}
else{
header("location:../index.php");
}

//VARIABLES CON LAS ACCIONES CREAR-MODIFICAR-ELIMINAR

$crear="Crear";
$modificar="Modificar";
$eliminar="Eliminar";
		   
		
//CONEXION A LA BASE DE DATOS PARA CONOCER LOS USUARIOS SUPERADMIN

require_once "../conections/BaseDatos.php";
$objet=new usuarios();
$super=($objet->superAdmin());
while ($superAdmin=mysqli_fetch_row($super)){
	if($superAdmin[0] == $_SESSION['username']){
	$roles=2;
	}
}
//CONDICIONAL PARA CREAR LA VARIABLE CON EL VALOR DE ROL

if(isset($_SESSION['rol'])){

if(($_SESSION['rol']==0) && ($roles==2)){

$rol=2;
}else{
if($_SESSION['rol']==0){
	$rol =0;
	
}else{
	$rol=1;

}
}
}

// ORDENAR LISTAS PRODUCTOS


$obje=new Productos();
$numFilas=$obje->obtenerRegistrosTotalesProductos();
$result=($obje->ordenarListaProductosPorID());

// VARIABLE PASADA POR URL CON ID DEL PRODUCTO
if(isset($_GET['opcionOrden'])) {
$opcionOrdenar=$_GET['opcionOrden'];

	$obje=new Productos();
	$numFilas=$obje->obtenerRegistrosTotalesProductos();
    switch ($opcionOrdenar){
		
			case 1:
			$result=($obje->ordenarListaProductosPorID());
			break;
			case 2:
			$result=($obje->ordenarListaProductosPorCategoria());
			break;
			case 3:
			$result=($obje->ordenarListaProductosPorNombre());
			break;
			case 4:
			$result=($obje->ordenarListaProductosPorCoste());
			break;
			case 5:
			$result=($obje->ordenarListaProductosPorPrecio());
			break;

	}
}


	
	$pagina =1;
	$mostrar=10;
	$totPaginas=$numFilas/$mostrar;
	// $inicioPaginas=($pagina - 1) * $totPaginas;
	?>


			
				 
	

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
	
	<script src="../libraries/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="../css/estilos.css"> 
    <title>Document</title>
</head>
<body>
    <!-- <?php echo "HOLAAAA $totPaginas and $rol"; ?>  -->

 <table class="table table-bordered table-active" style="text-align: center;">
	<caption><label class="titulo-seccion">Articulos</label></caption>
	<tr>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=1">Id</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=2">Categoria</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=3">Nombre</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=4">Coste</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=5">Precio</a></td>
		<?php if($rol==2): ?>
			<?php echo "
		<td class='bg-primary centar-cabecera'> <h5>Editar</h5></td>
		"?>
		<?php endif ?>
		<?php if($rol ==2): ?>
			<?php echo"
	    <td class='bg-primary centrar-cabecera'> <h5>Eliminar</h5></td>"?>
		<?php endif ?>
	</tr>
    <?php
  
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 
				
	<tr>
		<td class="td-white"><?php echo $ver[2] ?></td>
		<td class="td-white"><?php echo $ver[1] ?></td>
		<td class="td-white"><?php echo $ver[3] ?></td>
		<td class="td-white"><?php echo $ver[4] ?></td>
		<td  class="td-white"><?php echo $ver[5] ?></td>
		<?php if($rol ==2): ?>
				<?php echo"
		<td  class='td-white editar'>
			<span class='btn btn-warning btn-xs'>
				<a style='color: white;' class='glyphicon glyphicon-pencil' href='../formArticulos.php?upd=$ver[2]&accion=$modificar'></a>
			</span>
		</td>" ?>
		<?php endif ?>
		<?php if($rol==2): ?>
			<?php echo "
		<td class='td-white'>
			<span  class='btn btn-danger btn-xs' >			
				<a style='color: white;' class='glyphicon glyphicon-remove' href='../formArticulos.php?upd=$ver[2]&accion=$eliminar'></a>
			</span>
		</td>" ?>
		<?php endif ?>
	</tr>
    <?php endwhile; 
    ?>
</table>

<nav aria-label="Page navigation example" style="text-align: center;">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Anterior</a></li>

	<?php for($i=0;$i<$totPaginas;$i++): ?>
	<li class="page-item"><a class="page-link" href="#"><?php echo "$i" + 1 ?></a></li>
    <?php endfor ?>
  
    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
  </ul>
</nav> 
<button type="button" class="btn botPosition btn-lg btn-danger" onclick="location.href='../acceso.php'">Volver</button>
<?php if(($rol==2)||($rol==1)) echo "
<button class='btn btn-lg btn-primary botCrear'><a href='../formArticulos.php?upd=1&accion=Crear'>Crear nuevo producto</a> </button>"
?>
<script src="../funcion.js"></script>

</body>


</html> 



