<?php 
session_start();
session_destroy(); //Destruyo la sesion para crear otra nueva en el index.php
header("location:../index.php");
?>