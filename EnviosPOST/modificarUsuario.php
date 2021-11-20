<?php  
require_once "../conections/BaseDatos.php";



//ARRAY DEL FORMULARIO MODIFICAR USUARIOS
$obj=new usuarios();
$dato=array(
    $_POST['idUsuario'],
    $_POST['nombre'],
    $_POST['email'],
    $_POST['fecha'],
    $_POST['enabled']
);
 $obj->actualizarUsuario($dato);
 header("Location:../formUsuarios.php?upd=$dato[0]&accion=modificado")

?>