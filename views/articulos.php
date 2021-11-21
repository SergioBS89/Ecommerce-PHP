<?php

session_start();

// varibles para conocer el rol (no cambiar de sitio)
$rol=null;
$roles =null;


//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("../location:index.php");
}

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

// CONDICIONAL PARA PASAR POR URL LA PAGINA ACTUAL DE LA PAGINACION
If(!$_GET){
	header('Location:articulos.php?pagina=1&opcionOrden=1');
	}   
		


// ORDENAR LISTAS PRODUCTOS
$obje=new Productos();
$numFilas=$obje->obtenerRegistrosTotalesProductos();

$mostrar=10;		
$totPaginas=$numFilas/$mostrar;
$inicioPaginas=($_GET['pagina']-1) * $mostrar;

$paginasOrden=($_GET['pagina']-1) * $mostrar;


settype($inicioPaginas,"integer");
settype($mostrar,"integer");

$result=($obje->ordenarListaProductosPorID($inicioPaginas,$mostrar));


// VARIABLE PASADA POR URL CON ID DEL PRODUCTO

if(isset($_GET['opcionOrden'])) {

$opcionOrdenar=$_GET['opcionOrden'];

    switch ($opcionOrdenar){
		
			case 1:
			$result=($obje->ordenarListaProductosPorID($inicioPaginas,$mostrar));
			break;
			case 2:
			$result=($obje->ordenarListaProductosPorCategoria($inicioPaginas,$mostrar));
			break;
			case 3:
			$result=($obje->ordenarListaProductosPorNombre($inicioPaginas,$mostrar));
			break;
			case 4:
			$result=($obje->ordenarListaProductosPorCoste($inicioPaginas,$mostrar));
			break;
			case 5:
			$result=($obje->ordenarListaProductosPorPrecio($inicioPaginas,$mostrar));
			break;

	}
}
	
	?>	
				<!--CODIGO HTML DE LA PAGINA ARTICULOS -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/estilos.css"> 
    <title>Document</title>
</head>
<body>
  

 <table class="table table-bordered table-active" style="text-align: center;">
	<caption><label class="titulo-seccion">ARTICULOS</label></caption>
	<tr>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=1&pagina=1">Id</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=2&pagina=1">Categoria</a></td>
		<td style="width: 400px;" class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=3&pagina=1">Nombre</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=4&pagina=1">Coste</a></td>
		<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=5&pagina=1">Precio</a></td>
		<?php if($rol==2): ?>
		<td class='bg-primary header-mof-eli'><a href="">Modificar</a> </td>
	    <td class='bg-primary header-mof-eli'><a href="">Eliminar</a> </td>
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
		<td  class='td-white'>
			<span class='btn btn-warning btn-xs  centrar-icono'>
				<a style='color: white;' class='glyphicon glyphicon-pencil' href='../formArticulos.php?upd=$ver[2]&accion=Modificar'></a>
			</span>
		</td>" ?>
		<?php endif ?>
		<?php if($rol==2): ?>
			<?php echo "
		<td class='td-white'>
			<span  class='btn btn-danger btn-xs  centrar-icono' >			
				<a style='color: white;' class='glyphicon glyphicon-remove' href='../formArticulos.php?upd=$ver[2]&accion=Eliminar'></a>
			</span>
		</td>" ?>
		<?php endif ?>
	</tr>
    <?php endwhile; 
    ?>
</table>

<nav aria-label="Page navigation example" style="text-align: center;">
  <ul class="pagination">
    <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?> ">
		<a class="page-link" href="<?php echo 'articulos.php?pagina='. $_GET['pagina']-1 . '& opcionOrden=' . $_GET['opcionOrden']?>">Anterior</a>
	</li>

	<?php for($i=0;$i<$totPaginas;$i++): ?>
	<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>">
		<a class="page-link" href="<?php echo 'articulos.php?pagina='. $i+1 . '& opcionOrden=' . $_GET['opcionOrden']?>">
		<?php echo "$i" + 1 ?>
	</a>
    </li>
    <?php endfor ?>
  
    <li class="page-item <?php echo $_GET['pagina'] >= $totPaginas ? 'disabled' : ''?>">
	<a class="page-link" href="<?php echo 'articulos.php?pagina='. $_GET['pagina']+1 . '& opcionOrden=' . $_GET['opcionOrden']?>">Siguiente</a></li>
  </ul>
</nav> 
<button type="button" class="btn botPosition btn-lg btn-danger" onclick="location.href='../acceso.php'">Volver</button>
<?php if(($rol==2)||($rol==1)) echo "
<button class='btn btn-lg btn-primary botCrear'><a href='../formArticulos.php?upd=1&accion=Crear'>Crear nuevo producto</a> </button>"
?>
</body>
</html> 



