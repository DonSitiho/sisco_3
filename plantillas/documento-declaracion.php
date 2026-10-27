<?php
	  include('ajax/conexion.php');

header('Content-Type: text/html; charset=UTF-8');
session_start();
$id_direccion=$_SESSION['id_direccion'];
if(isset($_SESSION['nombre']) && $id_direccion==0){
	$Usuario = $_SESSION['nombre'];
	$nom_direccion=$_SESSION['nombre_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$imagen=$_SESSION['ruta'];

	$newImage = substr($imagen, 6);
	
	/* $Depdencencia = $_SESSION['id_direccion'];
	 $Departamento = $_SESSION['id_usuario'];
	$nombre_usr = $_SESSION[ 'nombre_usr' ];*/
}else{
 header('Location: index.php');//Aqui lo redireccionas al lugar que quieras.
     die() ;

    }

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> -->
    
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="plantilla/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="plantilla/css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="plantilla/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="plantilla/css/custom.css">
    <!-- Favicon-->
   <link rel="shortcut icon" href="../images/header-icon.png">

    <link rel="stylesheet" href="css/floating-labels.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="librerias/select2/css/select2.css">


    <title>SISCO </title>
</head>

<body>