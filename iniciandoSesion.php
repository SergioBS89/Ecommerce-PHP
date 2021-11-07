<?php 
session_start();

if(isset($_SESSION['rol'])){
    
switch ($_SESSION['rol']){

case 0:
header("location:views/acceso_userRegistrado.php");
break;
case 1:
header("location:views/acceso_userAuto.php");
break;
default:
header("location:acceso.php");
}
}
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>