<!-- CODIGO PHP -->
<?php 
session_start();

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
	else{
		header('Location:../index.php');
	}
}

// Creo un condicional si no existe las varibles, las manda con get a la url (Para la paginacion)
If(!$_GET){
	header('Location:usuarios.php?pagina=1');
	}   

// boque de codigo para la paginación
$obj = new usuarios();
$numFilas=$obj->obtenerRegistrosTotalesUsuarios();//funcion que devuelve el total de usuarios
$mostrar=10;//Usuarios a mostrar en la lista
$totPaginas=$numFilas/$mostrar;
$inicioPaginas=($_GET['pagina']-1) * $mostrar;//Obtine el numero de pagina actual con get

// convierto en integer las varibles 
settype($inicioPaginas,"integer");
settype($mostrar,"integer");
// llamo a la funcion que ordena los usuarios por su id, por defecto
$result=($obj->ordenarListaUsuariosPorID($inicioPaginas,$mostrar));

//código para determinar el orden de las listas al presionar en la cabecera
if(isset($_GET['opcionOrden'])) {

	$opcionOrdenar=$_GET['opcionOrden'];//Obtine el valor para ordenar la lista

	//con el switch dertermino que orden tiene que tener cada listado, llamando asi a su respectiva funcion
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
 ?>

 <!-- CÓDIGO HTML -->

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">    	
    	<link rel="stylesheet" href="../css/estilos.css"> 
        <title>Usuarios</title>
    </head>
    <body>
       
    
        <table class="table table-bordered table-active" style="text-align: center;">
        <caption><label class="titulo-seccion">USUARIOS</label></caption>
            <tr>
    			<!-- Cada boton envia por url la opcion para el orden de la lista y el numero de pagina -->
            	<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=1&pagina=1">Id</a></td>
            	<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=2&pagina=1">Nombre</a></td>
            	<td style="width: 400px;" class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=3&pagina=1">Email</a></td>
            	<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=4&pagina=1">Último acceso</a></td>
            	<td class="bg-primary td-articulos"><a href="usuarios.php?opcionOrden=5&pagina=1">Enabled</a></td>
            	<td class='bg-primary header-modi-eli'><a href="">Modificar</a> </td>
                <td class='bg-primary header-modi-eli'><a href="">Eliminar</a> </td>
            </tr>
    
    		 <!-- Con el bucle while iteramos todos los registros de usuarios y los imprimimos -->
            <?php	
            while ($ver=mysqli_fetch_row($result)):
            ?>    			
            <tr>
    			<!--Si los usuarios son superadmin, se les agrega la clase que les da el color rojo -->
                <?php 
                $super=($obj->superAdmin());
                while ($superAdmin=mysqli_fetch_row($super)){                   
                    if($superAdmin[0]==$ver[2]){
                    echo"
                   <td  class='td-white adminRed'>$ver[0]</td>
            	   <td  class='td-white adminRed'> $ver[2]</td>
            	   <td  class='td-white adminRed'> $ver[1]</td>
            	   <td  class='td-white adminRed'> $ver[3]</td>
            	   <td  class='td-white adminRed'>$ver[4]</td>
            	   <td  class='td-white editar'>
            	        <span class='btn btn-warning btn-xs'>
            	        	<a style='color: white;' class='glyphicon glyphicon-pencil' href=''></a>
            	        </span>
                   </td >
                   <td class='td-white eliminar'>
                   	    <span  class='btn btn-danger btn-xs' >			
                   	    	<a style='color: white;' class='glyphicon glyphicon-remove' href=''></a>
                   	    </span>
                   </td>";}
    			    //Si los usuarios no son superadmin, se imprimen por defecto    
                    else{
                    echo "
                        <td class='td-white'>$ver[0]</td>
                	    <td class='td-white'>$ver[2]</td>
                	    <td class='td-white'>$ver[1]</td>
                	    <td class='td-white'>$ver[3]</td>
                	    <td class='td-white'>$ver[4]</td>
                	    <td class='td-white editar'>
                	        <span class='btn btn-warning btn-xs'>
                	        	<a style='color: white;' class='glyphicon glyphicon-pencil' href='../formUsuarios.php?upd=$ver[0]&accion=Modificar'></a>
                	        </span>
                        </td >
                        <td class='td-white eliminar'>
                        	<span  class='btn btn-danger btn-xs' >			
                        		<a style='color: white;' class='glyphicon glyphicon-remove' href='../formUsuarios.php?upd=$ver[0]&accion=Eliminar'></a>
                        	</span>
                        </td>
                    ";}}?>       
            </tr>
            <?php endwhile;?>
    	</table>
    
    	<!-- Paginacion-->
        <nav aria-label="Page navigation example" style="text-align: center;">
          <ul class="pagination">
    		<!-- Si la pagina es menor o igual a 1 se agrega la propiedad disabled al boton-->
            <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?> ">
    		     <!-- obtenemos con get el numero de pagina y de orden con get desde la url (para el boton anterior) -->
        		<a class="page-link" href="<?php echo 'usuarios.php?pagina='. $_GET['pagina']-1?>">Anterior</a>
        	</li>    
        	<?php for($i=0;$i<$totPaginas;$i++): ?><!--Iteramos todas las paginas-->
    		<!-- con un operador ternario determino que numero de pagina estamos mostrando y le agrega la prodiedad active -->
        	<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>">
    		     <!-- obtenemos el numero de pagina con la iteracion del for y el orden con get desde la url-->
        		<a class="page-link" href="usuarios.php?pagina=<?php echo $i+1?>">
    			<!-- se imprimen los numeros de las paginas dinamicamente -->
        		<?php echo "$i" + 1 ?>
        	    </a>
            </li>
            <?php endfor ?>
            	<!-- Si la pagina es mayor al total de paginas se agrega la propiedad disabled al boton-->    
            <li class="page-item <?php echo $_GET['pagina'] >= $totPaginas ? 'disabled' : ''?>">
    		     <!-- obtenemos con get el numero de pagina y de orden con get desde la url (para el boton siguiente) -->
                <a class="page-link" href="<?php echo 'usuarios.php?pagina='. $_GET['pagina']+1?>">Siguiente</a>
            </li>
          </ul>
        </nav> 
        <button type="button" class="btn botPosition btn-lg btn-danger" onclick="location.href='../acceso.php'">Volver</button>    
        <button class='btn btn-lg btn-primary botCrear'><a href='../formUsuarios.php?upd=1&accion=Crear'>Crear nuevo usuario</a> </button>
    </body>
</html> 