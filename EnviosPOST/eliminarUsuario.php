<?php  
session_start();
require_once "../conections/BaseDatos.php";



//ARRAY DEL FORMULARIO ELIMINAR USUARIO
    $obj=new usuarios();
    $dato=array(
        $_POST['idUsuario']
    );
     $obj->eliminarUsuario($dato);

     header("Location:../formUsuarios.php?upd=$dato[0]&accion=eliminado")
?>