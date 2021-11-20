
<?php  
session_start();
require_once "../conections/BaseDatos.php";

// ARRAY DEL FORMULARIO ELIMINAR productos
$datos=array(
    $_POST['idProducto']
);
$objeto =new Productos();
$objeto->eliminarProducto($datos);

header("Location:../formArticulos.php?upd=$datos[0]&accion=eliminado")
// ARRAY DEL FORMULARIO ELIMINAR USUARIO
    // $obj=new usuarios();
    // $dato=array(
    //     $_POST['idUsuario']
    // );
    //  $obj->eliminarUsuario($dato);


?>