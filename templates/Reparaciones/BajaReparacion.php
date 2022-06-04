<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();
     
if(!$auth){

    header('Location: /');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $fegreso = $_POST['fegreso'];
    $cod_libro = $_POST['cod_libro'];

    //Query para actualizar el libro en reparacion
    $query = "UPDATE reparacion SET fegreso = '$fegreso'  WHERE cod_libro = $cod_libro";

    //Query para cambiar el estado del nuevo libro
    $cambiarEstado1 = "UPDATE libro SET estado = 'En biblioteca' WHERE cod_libro = $cod_libro";

    //insertar en la DB
    $resultado1 = mysqli_query(conectarDB(), $query);
    $resultado2 = mysqli_query(conectarDB(), $cambiarEstado1);

    if($resultado1 && $resultado2){
        //Redireccionar al usuario.
        header('Location: /templates/Reparaciones/ListaReparacion.php');
    }else{
        echo 'Revisar SQL';
    }
}

if(isset($_GET['id'])){

    if (is_numeric($_GET['id'])){

        $cod_libro = $_GET['id'];

        //query para traer la tabla completa
        $query = "SELECT * FROM reparacion r JOIN libro l ON r.cod_libro = l.cod_libro WHERE r.cod_libro = $cod_libro";
        //hago la consulta
        $resultado = mysqli_query(conectarDB(), $query);


    if($resultado){

    $libro = mysqli_fetch_assoc($resultado);

    //Me traigo la fecha de ingreso para ponerle un min al formulario
    $fingreso = $libro['fingreso'];

    include '../../Header.php';
    ?>
 
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Egreso de Reparación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        
                    <form action="/templates/Reparaciones/BajaReparacion.php" method='POST'>
                            
                            <div class="form-group">
                            <label for="cod_libro">Libro</label>
                            <input type="hidden" name="cod_libro" id="cod_libro" class="form-control" value="<?php echo $libro['cod_libro']?>">
                            <input type="text" readonly id="cod_libro" class="form-control" value="<?php echo $libro['cod_libro'] . " - " . $libro['titulo']?>">
                            </div>
                    
                            
                            <div class="form-group">
                                <label for="motivo">Motivo de Ingreso</label>
                                <input type="text" readonly name="motivo" id="motivo" class="form-control" value="<?php echo $libro['motivo']?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="fegreso">Fecha de Egreso</label>
                            <input type="date" min="<?php echo $fingreso ?>" name="fegreso" id="fegreso" class="form-control">
                            </div>

                            </div>
                            <div class="modal-footer">
                                <a name="" id="" class="btn btn-secondary" href="/templates/Reparaciones/ListaReparacion.php" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Dar la baja</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>





<?php } }else{
        header('Location: /templates/Reparaciones/ListaReparacion.php');
    }
}
include '../../Footer.php';
?>