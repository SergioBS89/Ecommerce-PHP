<?php  
session_start();
require_once "conections/BaseDatos.php";


 $objeto =new Productos();

 $datoCrear=array(
    $_POST['categoriaCrear'],
    $_POST['nombreCrear'],
    $_POST['costeCrear'],
    $_POST['precioCrear']  
);
$objeto->crearProducto($datoCrear);


 // ARRAY DEL FORMULARIO CREAR USUARIOS
 $obj=new usuarios();
 $dato=array(
     $_POST['nombre'],
     $_POST['email'],
     $_POST['fecha'],
     $_POST['enabled']
 );
  $obj->crearUsuario($dato);

    ?>