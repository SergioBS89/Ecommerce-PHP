
<?php  
session_start();
require_once "../conections/BaseDatos.php";

$objeto =new Productos();

//Array que recoge los datos enviados por POST
$datos=array(
$_POST['idProducto']
);

//Llamo a la funcion para eliminar el producto
$objeto->eliminarProducto($datos);

// Mando de vuelta con el metodo get las varibales upd con el id del usuario y la accion 'eliminado'
header("Location:../formArticulos.php?upd=$datos[0]&accion=eliminado");
?>