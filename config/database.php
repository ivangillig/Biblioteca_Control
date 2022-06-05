<?php


function conectarDB() : mysqli {
    //$db = mysqli_connect('localhost', 'root', '', 'biblioteca');
    
    $db = mysqli_connect (
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_BD']
            );

    if(!$db){
        echo 'Error no se pudo conectar';
        exit;
    }

    //Cambio la codificación de la DB para que me tome Ñ y acentos
    $db->set_charset("utf8");

    return $db;
}
?>
