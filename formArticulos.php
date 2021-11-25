<!-- CODIGO HTML-->
<?php  
session_start();

//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("location:index.php");
}

//obtenemos el valor del id del producto
if(isset($_GET['upd'])) 
$idArticulo=$_GET['upd'];

//obtenemos el valor de accion, para crear, modificar o eliminar
if(isset($_GET['accion']))
$accion=$_GET['accion'];

//llamamos a la funcion para que devuelva los datos del producto 
require_once "conections/BaseDatos.php";
$obje=new Productos();
$result=$obje->mostrarProductoModificarEliminar($idArticulo);

//Funcionas para obtener los select options 
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
        <title>Formulario Articulos</title>
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
        <div class='container' style='display:none'>
        ";}else{ //de lo contrario, se muestra
		echo"
    	<div class='container'>
        ";}?>

		    <div class="row">
		    	<div class="col-lg-4"></div>
		    	<div class="col-lg-4">
		    		<div style="height: 200px" class="panel panel-primary">
		    		    <!--Imprimo la acción que se realiza para el titulo del formuario  -->
		    			<div class="panel panel-heading form-name-position"><?php echo "<h4> $accion articulo </h4>" ?></div>
		    			<div class="panel panel-body">
                            <!--la etiqueta form tendra un action que manda los datos a modificarArticulo.php-->
		    			    <?php  if($accion == 'Modificar'){ 
		    				echo"
		    	       	    <form class='cont-form' method='post' action='EnviosPOST/modificarArticulo.php'>
		    	            ";}else{ //la etiqueta form tendra un action que manda los datos a eliminarArticulo.php
		    				echo"
		    			    <form class='cont-form' method='post' action='EnviosPOST/eliminarArticulo.php'> 
		    	            ";}?>
		                		<label>Id</label>                          
		                		<input  type="text" readonly class="form-control input-sm" name="idProducto" value="<?php echo $ver[2] ?>">
		                		<label>Categoria</label>
		    					<!--si estamos eliminando, el input es de solo lectura-->
		                		<?php if($_GET['accion']=='Eliminar'): ?>			
		                	    <input readonly type="text" class="form-control input-sm" name="categori" value='<?php echo" $ver[1]";?>' >
		                	    <?php endif?>            
		                	    <!-- Select con las options para modificar la categoria del producto-->
		                	    <?php if($_GET['accion']=='Modificar'): ?>	
		                	    <select name='categoria'>         
	                                <?php
		                		    while($allOptions=mysqli_fetch_row(($result1))){
		                		    	if($ver[1]==$allOptions[0]){//se busca la categoria del producto para agregar la propiedad selected
                                    echo"
		    					    <option selected value='$allOptions[1]'>$allOptions[0]</option>";}
		                	        else{
		                	        echo "<option value='$allOptions[1]'>$allOptions[0]</option>";
		                	        }}?>		            	  
                                </select>	
		                	    <?php endif ?>
		                	    <!-- Corrijo el espacio que deja el select (solo es estetico)-->
		                	    <?php  if($accion=='Modificar'){
		                		  echo "<p></p>";
		                	    }?>	 
		    					<!--si accion es modificar imprime las siguientes etiquetas -->
		                	    <?php if($accion=='Modificar'){  
		    					echo"
                                <label style='margin-top: 10px;'>Nombre</label>
		                		<input type='text'class='form-control input-sm' name='nombre' id='nombre' value='$ver[3]' required>
                                <label>Coste</label>
		                		<input type='text'class='form-control input-sm' name='coste' id='coste' value='$ver[4]' required>
                                <label>Precio</label>
		                		<input type='text' class='form-control input-sm' name='precio' id='precio' value='$ver[5]' required>                 
		                		<br>
		                		";} else{ //si accion es eliminar, imprime las siguientes etiquetas
		    					echo"
		                	    <label style='margin-top: 10px;'>Nombre</label>
		                	    <input readonly type='text'class='form-control input-sm' name='nombre' id='nombre' value=' $ver[3]' >
		                	    <label>Coste</label>
		                	    <input readonly type='text'class='form-control input-sm' name='coste' id='coste' value='$ver[4]' >
		                	    <label>Precio</label>
		                		<input readonly type='text' class='form-control input-sm' name='precio' id='precio' value='$ver[5]'>                 
		                		<br>
		                		";}?>     
                                <!--Si accion es modificar, se crea el boton modificar-->
		                	    <?php  if($accion == 'Modificar'){ 
		    					echo"
		                	    <button type='submit' class='btn btn-primary btn-sm btn-accion'>Modificar</button> 
		                	    ";}else{ //Si la acción es eliminar, se crea el boton eliminar
		    					echo"
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
        <?php endwhile ?>

        <!--Formulario que aparece cuando la accion es 'Crear'-->
        <?php  //Si accion es diferente a crear, desaparece el formulario
        if(isset($_GET['accion'])) if($accion!='Crear'){
		echo"
        <div class='container' style='display:none'>
        ";}else{//de lo contrario, imprime el formulario
		echo"
        <div class='container'>
        ";}?>
        	<div class="row">
        		<div class="col-lg-4"></div>
        		<div class="col-lg-4">
        			<div style="height: 200px" class="panel panel-primary">
        				<div class="panel panel-heading form-name-position"><?php echo "<h4> $accion articulo </h4>" ?></div>
        				<div class="panel panel-body">            					
        					<form class="cont-form" method="post" action="EnviosPOST/crearArticulo.php">
                                <label>Categoria</label>
        			            <select name="categoria" required>
								<!-- se imprimen todas las categorias en los options del select -->
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

	    <!--Mensaje de confirmacion-->  

        <?php //Si se cumple la condicion, aparece el mensaje operacion realizada
		if(isset($_GET['accion'])) if(($_GET['accion']=='modificado')||($_GET['accion']=='eliminado')||($_GET['accion']=='creado')): ?>
	    <div class="container-mensage">
	    	<h3 style="text-align: center;">Operación realizada con exito!</h3>
	    	<span class="btn btn-danger btn-sm btn-accion" onclick="location.href='views/articulos.php'"><?php echo "<h5> Volver</h5>" ?></span>
	    </div>   
	    <?php endif;?>  
    </body>
</html>