<?php

//------------------------------------------------------------------------------------
TRABAJO PRACTICO PARA LA FACULTAD, EVITA MODIFICAR LA BASE DE DATOS, APP DE PRUEBA
//------------------------------------------------------------------------------------

function conectarDB() : mysqli {
    $db = mysqli_connect('us-cdbr-east-05.cleardb.net', 'bf0d4e6b52a0ac', '5a4d20c3', 'heroku_882f3b2d978bb47');
    
    if(!$db){
        echo 'Error no se pudo conectar';
        exit;
    }

    //Cambio la codificación de la DB para que me tome Ñ y acentos
    $db->set_charset("utf8");

    return $db;
}
?>
