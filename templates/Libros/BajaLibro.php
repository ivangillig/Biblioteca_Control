<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}
if(isset($_GET['id'])){
    $cod_libro = $_GET['id'];

    $query = "SELECT cod_libro FROM libro  WHERE cod_libro = $cod_libro AND estado = 'En biblioteca'";
    $resultado = mysqli_query(conectarDB(), $query);

    if ($resultado -> num_rows){

        $query = "DELETE FROM libro WHERE cod_libro = $cod_libro";
        $resultado = mysqli_query(conectarDB(), $query);

        if (!$resultado -> num_rows){
            header('Location: /templates/Libros/ListaLibros.php');
            }
    }else{
        header( "refresh:5; url=/templates/Libros/ListaLibros.php" ); //Redireccion en 5 segundos

        include '../../Header.php';
        ?>

        <div class="container mt-5 alert alert-danger alert-dismissible fade show w-50" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Atención!</strong> No se puede eliminar por tener préstamos/reparaciones registrados. Serás redireccionado en 5 segundos...
        </div>

<?php     }

}

include '../../Footer.php';
?>