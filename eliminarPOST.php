
<?php  
session_start();
require_once "conections/BaseDatos.php";

$datosEliminar=array(
    $_POST['idProducto']
);
$objeto3 =new Productos();
$objeto3->eliminarProducto($datosEliminar);

?>