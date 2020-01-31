<?php
session_start();
include("conexion.php");

$nombre_usuario = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_usuario"],ENT_QUOTES)));
$contrasena = md5($_POST["contrasena"]);
$cek = mysqli_query($con, "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario' AND contrasena='$contrasena'");
if(mysqli_num_rows($cek) == 0){
	$_SESSION['mensaje_error'] = 'Los datos ingresados son incorrectos. Por favor intentelo nuevamente..';
    header("Location: login.php");	
}
else{
    $row = mysqli_fetch_assoc($cek);
    session_start();
	$_SESSION['loggedin'] = true;
	$_SESSION['nombre_usuario'] = $row['nombre_usuario'];
	$_SESSION['id'] = $row['id'];
    header("Location: index.php");	
}
