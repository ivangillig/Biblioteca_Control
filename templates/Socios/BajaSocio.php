<?php include '../../config/funciones.php';
     
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}
if(isset($_GET['id'])){
    $cod_socio = $_GET['id'];

    $query = "SELECT s.cod_socio FROM socio s JOIN prestamo p ON s.cod_socio = p.cod_socio WHERE s.cod_socio = $cod_socio AND p.fecha_devolucion IS Null";
    $resultado = mysqli_query(conectarDB(), $query);

    if (!$resultado -> num_rows){

        $query = "DELETE FROM socio WHERE cod_socio = $cod_socio";
        $resultado = mysqli_query(conectarDB(), $query);

        if (!$resultado -> num_rows){
            header('Location: /templates/Socios/ListaSocio.php');
            }
    }else{

        
        header( "refresh:5; url=/templates/Socios/ListaSocio.php" ); //Redireccion en 5 segundos

        include '../../Header.php';
        ?>

        <div class="container mt-5 alert alert-danger alert-dismissible fade show w-50" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Atención!</strong> No se puede eliminar por tener préstamos registrados. Serás redireccionado en 5 segundos...
        </div>

<?php     }

}

include '../../Footer.php';
?>