<?php


function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'biblioteca');

    if(!$db){
        echo 'Error no se pudo conectar';
        exit;
    }

    //Cambio la codificación de la DB para que me tome Ñ y acentos
    $db->set_charset("utf8");

    return $db;
}
?>
