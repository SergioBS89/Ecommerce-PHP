<?php 
	require_once "conections/BaseDatos.php";

    // ARRAY DEL FORMULARIO MODIFICAR ARTICULOS
    $objeto=new Productos();
    $datos=array(
        $_POST['idProducto'],
        $_POST['categori'],
        $_POST['categoria'],
        $_POST['nombre'],
        $_POST['coste'],
        $_POST['precio']  
    );
     $objeto->actualizarProducto($datos);
    
    // ARRAY DEL FORMULARIO MODIFICAR USUARIOS
    $obj=new usuarios();
    $dato=array(
        $_POST['idUsuario'],
        $_POST['nombre'],
        $_POST['email'],
        $_POST['fecha'],
        $_POST['enabled']
    );
     $obj->actualizarUsuario($dato);

?>