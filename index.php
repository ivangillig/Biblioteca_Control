<?php 
include 'config/funciones.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}

header('Location: /templates/Libros/ListaLibros.php');


?>