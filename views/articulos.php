<!-- CODIGO PHP -->
<?php
session_start();

// varibles para conocer el rol
$rol=null;
$roles =null;

//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("../location:index.php");
}

//Conexion a la base de datos para conocer los usuarios superadmin
require_once "../conections/BaseDatos.php";
$objet=new usuarios();
$super=($objet->superAdmin());
while ($superAdmin=mysqli_fetch_row($super)){
	if($superAdmin[0] == $_SESSION['username']){
	$roles=2;
	}
}

// Condicion para crear la variable con el valor del rol del usuario
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

// Creo un condicional si no existe las varibles, las manda con get a la url (Para la paginacion)
If(!$_GET){
	header('Location:articulos.php?pagina=1&opcionOrden=1');
	}   

// boque de codigo para la paginación
$obje=new Productos();
$numFilas=$obje->obtenerRegistrosTotalesProductos(); //funcion que devuelve el total de productos
$mostrar=10; //Productos a mostrar en la lista		
$totPaginas=$numFilas/$mostrar; 
$inicioPaginas=($_GET['pagina']-1) * $mostrar; //Obtine el numero de pagina actual con get

// convierto en integer las varibles 
settype($inicioPaginas,"integer");
settype($mostrar,"integer");
// llamo a la funcion que ordena los productos por su id, por defecto
$result=($obje->ordenarListaProductosPorID($inicioPaginas,$mostrar));

//código para determinar el orden de las listas al presionar en la cabecera
if(isset($_GET['opcionOrden'])) {
$opcionOrdenar=$_GET['opcionOrden'];//Obtine el valor para ordenar la lista
    
//con el switch dertermino que orden tiene que tener cada listado, llamando asi a su respectiva funcion
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

<!--CÓDIGO HTML-->

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../css/estilos.css"> 
        <title>Articulos</title>
    </head>
    <body>
        <table class="table table-bordered table-active" style="text-align: center;">
    	<caption><label class="titulo-seccion">ARTICULOS</label></caption>
    	    <tr>
				<!-- Cada boton envia por url la opcion para el orden de la lista y el numero de pagina -->
    	    	<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=1&pagina=1">Id</a></td>
    	    	<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=2&pagina=1">Categoria</a></td>
    	    	<td style="width: 400px;" class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=3&pagina=1">Nombre</a></td>
    	    	<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=4&pagina=1">Coste</a></td>
    	    	<td class="bg-primary td-articulos"><a href="articulos.php?opcionOrden=5&pagina=1">Precio</a></td>
				<!-- Muestra los botones si el usuario es superadmin -->
    	    	<?php if($rol==2): ?>
    	    	<td class='bg-primary header-modi-eli'><a href="">Modificar</a> </td>
    	        <td class='bg-primary header-modi-eli'><a href="">Eliminar</a> </td>
    	    	<?php endif ?>
    	    </tr>
           <!-- Con el bucle while iteramos todos los registros de productos y los imprimimos -->
            <?php      
    	    while ($ver=mysqli_fetch_row($result)): 
    	    ?>				
	        <tr>
	        	<td class="td-white"><?php echo $ver[2] ?></td>
	        	<td class="td-white"><?php echo $ver[1] ?></td>
	        	<td class="td-white"><?php echo $ver[3] ?></td>
	        	<td class="td-white"><?php echo $ver[4] ?></td>
	        	<td  class="td-white"><?php echo $ver[5] ?></td>
				<!-- Mostramos los iconos de modificar y eliminar en funcion del rol -->
	        	<?php if($rol ==2): ?>
	        	<?php echo"
	        	<td  class='td-white'>
	        		<span class='btn btn-warning btn-xs'>
	        			<a style='color: white;' class='glyphicon glyphicon-pencil' href='../formArticulos.php?upd=$ver[2]&accion=Modificar'></a>
	        		</span>
	        	</td>" ?>
	        	<?php endif ?>
	        	<?php if($rol==2): ?>
	        		<?php echo "
	        	<td class='td-white'>
	        		<span  class='btn btn-danger btn-xs' >			
	        			<a style='color: white;' class='glyphicon glyphicon-remove' href='../formArticulos.php?upd=$ver[2]&accion=Eliminar'></a>
	        		</span>
	        	</td>" ?>
	        	<?php endif ?>
	        </tr>
             <?php endwhile; ?>
        </table>

		<!-- Paginacion-->
        <nav aria-label="Page navigation example" style="text-align: center;">
            <ul class="pagination">
				<!-- Si la pagina es menor o igual a 1 se agrega la propiedad disabled al boton-->
                <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?> ">
				    <!-- obtenemos con get el numero de pagina y de orden con get desde la url (para el boton anterior) -->
          		    <a class="page-link" href="<?php echo 'articulos.php?pagina='. $_GET['pagina']-1 . '& opcionOrden=' . $_GET['opcionOrden']?>">Anterior</a>
          	    </li>          
          	<?php for($i=0;$i<$totPaginas;$i++): ?><!--Iteramos todas las paginas-->
				<!-- con un operador ternario determino que numero de pagina estamos mostrando y le agrega la prodiedad active -->
            	<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>">
				     <!-- obtenemos el numero de pagina con la iteracion del for y el orden con get desde la url-->
          		    <a class="page-link" href="<?php echo 'articulos.php?pagina='. $i+1 . '& opcionOrden=' . $_GET['opcionOrden']?>">
					  <!-- se imprimen los numeros de las paginas dinamicamente -->
          		    <?php echo "$i" + 1 ?>
          	        </a>
                </li>
                <?php endfor ?>        
				<!-- Si la pagina es mayor al total de paginas se agrega la propiedad disabled al boton-->    
                <li class="page-item <?php echo $_GET['pagina'] >= $totPaginas ? 'disabled' : ''?>">
				     <!-- obtenemos con get el numero de pagina y de orden con get desde la url (para el boton siguiente) -->
          	        <a class="page-link" href="<?php echo 'articulos.php?pagina='. $_GET['pagina']+1 . '& opcionOrden=' . $_GET['opcionOrden']?>">Siguiente</a>
			    </li>
            </ul>
        </nav> 
        <button type="button" class="btn btn-lg btn-danger botPosition " onclick="location.href='../acceso.php'">Volver</button>
		<!-- Se muestra el boton de crear si los usuarios no son registrados -->
        <?php if(($rol==2)||($rol==1)) echo "
        <button class='btn btn-lg btn-primary botCrear'><a href='../formArticulos.php?upd=1&accion=Crear'>Crear nuevo producto</a> </button>"
        ?>
    </body>
</html> 



