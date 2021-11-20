
<?php  
session_start();
require_once "conections/BaseDatos.php";

// ARRAY DEL FORMULARIO ELIMINAR productos
$datosEliminar=array(
    $_POST['idProducto']
);
$objeto3 =new Productos();
$objeto3->eliminarProducto($datosEliminar);

 
// ARRAY DEL FORMULARIO ELIMINAR USUARIO
    $obj=new usuarios();
    $dato=array(
        $_POST['idUsuario']
    );
     $obj->eliminarUsuario($dato);


?>