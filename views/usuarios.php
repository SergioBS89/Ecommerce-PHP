<?php 
session_start();

//Validacion de usuario
if($_SESSION['username']){}
else{
	header("location:../index.php");
}
require_once  "../conections/BaseDatos.php";
$obj = new usuarios();

//FUNCION PARA CONOCER EL NOMBRE DE LOS SUPERADMIN



// CONDICIONAL PARA PASAR POR URL LA PAGINA ACTUAL DE LA PAGINACION
If(!$_GET){
	header('Location:usuarios.php?pagina=1');
	}   

// ORDENAR LISTAS DE USUARIOS

$numFilas=$obj->obtenerRegistrosTotalesUsuarios();

$mostrar=10;		
$totPaginas=$numFilas/$mostrar;
$inicioPaginas=($_GET['pagina']-1) * $mostrar;

settype($inicioPaginas,"integer");
settype($mostrar,"integer");

$result=($obj->ordenarListaUsuariosPorID($inicioPaginas,$mostrar));

if(isset($_GET['opcionOrden'])) {

	$opcionOrdenar=$_GET['opcionOrden'];
	
		switch ($opcionOrdenar){
			
				case 1:
				$result=($obj->ordenarListaUsuariosPorID($inicioPaginas,$mostrar));
				break;
				case 2:
				$result=($obj->ordenarListaUsuariosPorNombre($inicioPaginas,$mostrar));
				break;
				case 3:
				$result=($obj->ordenarListaUsuariosPorEmail($inicioPaginas,$mostrar));
				break;
				case 4:
				$result=($obj->ordenarListaUsuariosPorFecha($inicioPaginas,$mostrar));
				break;
				case 5:
				$result=($obj->ordenarListaUsuariosPorEnabled($inicioPaginas,$mostrar));
				break;
	
		}
	}

// $result = ($obj->ordenarListaUsuariosPorID(0,5));


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
   

 <table class="table table-bordered table-active" style="text-align: center;">
	<caption><label class="titulo-seccion">USUARIOS</label></caption>
	<tr>
		<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=1&pagina=1">Id</a></td>
		<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=2&pagina=1">Nombre</a></td>
		<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=3&pagina=1">Email</a></td>
		<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=4&pagina=1">Último acceso</a></td>
		<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=5&pagina=1">Enabled</a></td>
		<td class='bg-primary centar-cabecera'> <h5>Editar</h5></td>
	    <td class='bg-primary centrar-cabecera'> <h5>Eliminar</h5></td>
	</tr>
    <?php
  
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 
				
	<tr>
        <?php 
        $super=($obj->superAdmin());
        while ($superAdmin=mysqli_fetch_row($super)){
    
            
        if($superAdmin[0]==$ver[2]){
            echo"
        <td class='td-white adminRed'>$ver[0]</td>
		<td class='td-white adminRed'> $ver[2]</td>
		<td class='td-white adminRed'> $ver[1]</td>
		<td class='td-white adminRed'> $ver[3]</td>
		<td class='td-white adminRed'>$ver[4]</td>";}
        else{
            echo "
        <td class='td-white'>$ver[0]</td>
		<td class='td-white'>$ver[2]</td>
		<td class='td-white'>$ver[1]</td>
		<td class='td-white'>$ver[3]</td>
		<td class='td-white'>$ver[4]</td>
	";}}?>
        
        <td class='td-white editar'>
			<span class='btn btn-warning btn-xs'>
				<a style='color: white;' class='glyphicon glyphicon-pencil' href='../formUsuarios.php?upd=<?php echo "$ver[0]"?> &accion=Modificar'></a>
			</span>
		</td >
        <td class='td-white eliminar'>
			<span  class='btn btn-danger btn-xs' >			
				<a style='color: white;' class='glyphicon glyphicon-remove' href='../formUsuarios.php?upd=<?php echo "$ver[0]"?> &accion=Eliminar'></a>
			</span>
		</td>
	
	</tr>
    <?php endwhile; 
    ?>
</table>

<nav aria-label="Page navigation example" style="text-align: center;">
  <ul class="pagination">
    <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?> ">
		<a class="page-link" href="<?php echo 'usuarios.php?pagina='. $_GET['pagina']-1?>">Anterior</a>
	</li>

	<?php for($i=0;$i<$totPaginas;$i++): ?>
	<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>">
		<a class="page-link" href="usuarios.php?pagina=<?php echo $i+1?>">
		<?php echo "$i" + 1 ?>
	</a>
    </li>
    <?php endfor ?>
  
    <li class="page-item <?php echo $_GET['pagina'] >= $totPaginas ? 'disabled' : ''?>">
    <a class="page-link" href="<?php echo 'usuarios.php?pagina='. $_GET['pagina']+1?>">Siguiente</a>
    </li>
  </ul>
</nav> 
<button type="button" class="btn botPosition btn-lg btn-danger" onclick="location.href='../acceso.php'">Volver</button>

<button class='btn btn-lg btn-primary botCrear'><a href='../formArticulos.php?accion=Crear'>Crear nuevo usuario</a> </button>


</body>


</html> 