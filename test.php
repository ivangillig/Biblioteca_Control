<?php


function calcularMenor(){

    $fecha_actual = Date('Y-m-d');
    $es_menor = date('Y-m-d',strtotime($fecha_actual.'- 18 year'));

    return $es_menor;
}


header( 'refresh:5; url=/' ); //Redireccion en 5 segundos

include 'Header.php';
?>


<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
</div>

<p>asñfosañfoa</p>
<?php include 'Footer.php';
?>