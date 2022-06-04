<?php
include '../../config/funciones.php';
include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){


    $cod_libro = $_POST['cod_libro'];
    $titulo = $_POST['titulo'];
    $editorial = $_POST['editorial'];
    $fedicion = $_POST['fedicion'];
    $idioma = $_POST['idioma'];
    $cantpaginas = $_POST['cantpaginas'];

    $query = "UPDATE libro SET titulo='$titulo', editorial='$editorial', fedicion='$fedicion', idioma='$idioma', cantpaginas='$cantpaginas' WHERE cod_libro = $cod_libro";
    $resultado = mysqli_query(conectarDB(), $query);

    
    if ($resultado){
        header('Location: /templates/Libros/ListaLibros.php');
    }else{
        echo 'Error al actualizar tabla';
    }
}

if(isset($_GET['id'])){

    $cod_libro = $_GET['id'];

    $query = "SELECT * FROM libro WHERE cod_libro = $cod_libro";
    $resultado = mysqli_query(conectarDB(), $query);
    $res = mysqli_fetch_assoc($resultado);

}
include '../../Header.php';
    if ($resultado -> num_rows){
        ?>

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Modificar Libro</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>
             <div class="modal-body">
                
             <form action="/templates/Libros/ModificarLibro.php" method='POST'>

                     <input type="hidden" name="cod_libro" class="form-control" value="<?php echo $cod_libro ?>">
                    
                     <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $res['titulo'] ?>">
                    </div>

                    <div class="form-group">
                    <label for="editorial">Editorial</label>
                    <input type="text" name="editorial" id="editorial" class="form-control" value="<?php echo $res['editorial'] ?>">
                    </div>

                    <div class="form-group">
                    <label for="fedicion">Fecha de edición</label>
                    <input type="date" name="fedicion" id="fedicion" class="form-control" value="<?php echo $res['fedicion'] ?>">
                    </div>

                    <div class="form-group">
                    <label for="idioma">Idioma</label>
                    <input type="text" name="idioma" id="idioma" class="form-control" value="<?php echo $res['idioma'] ?>">
                    </div>
                    
                    <div class="form-group">
                    <label for="cantpaginas">Cantidad de páginas</label>
                    <input type="number" name="cantpaginas" id="cantpaginas" class="form-control" value="<?php echo $res['cantpaginas'] ?>">
                    </div>
            

                    </div>
                    <div class="modal-footer">
                        <a name="" id="" class="btn btn-secondary" href="/templates/Libros/ListaLibros.php" role="button">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
             </form>
         </div>
     </div>
 </div>
        <?php
    
    }


include '../../Footer.php';
?>