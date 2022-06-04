<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();
     
if(!$auth){

    header('Location: /');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $cod_libro = $_POST['cod_libro'];
    $areemplazar = $_POST['areemplazar'];

    //Query para actualizar el libro en reparacion
    $query = "UPDATE reparacion SET cod_libro = $cod_libro WHERE cod_libro = $areemplazar";

    //Query para cambiar el estado del nuevo libro
    $cambiarEstado1 = "UPDATE libro SET estado = 'En reparación' WHERE cod_libro = $cod_libro";

    //Query para volver el libro anterior a la biblioteca
    $cambiarEstado2 = "UPDATE libro SET estado = 'En biblioteca' WHERE cod_libro = $areemplazar";

    //insertar en la DB
    $resultado1 = mysqli_query(conectarDB(), $query);
    $resultado2 = mysqli_query(conectarDB(), $cambiarEstado1);
    $resultado3 = mysqli_query(conectarDB(), $cambiarEstado2);

    if($resultado1 && $resultado2 && $resultado3){
        //Redireccionar al usuario.
        header('Location: /templates/Reparaciones/ListaReparacion.php');
    }else{
        echo 'Revisar SQL';
    }
}

if(isset($_GET['id'])){

    if (is_numeric($_GET['id'])){

        $areemplazar = $_GET['id'];

        //query para traer la tabla completa
        $query = "SELECT * FROM reparacion r JOIN libro l ON r.cod_libro = l.cod_libro WHERE r.cod_libro = $areemplazar";
        //hago la consulta
        $resultado = mysqli_query(conectarDB(), $query);


if($resultado){

    $libros = mysqli_fetch_assoc($resultado);

    //query para traer la tabla completa
    $query = "SELECT * FROM libro WHERE estado = 'En biblioteca'";
    $resultado2 = mysqli_query(conectarDB(), $query);

    include '../../Header.php';
?>
 
 <!-- Modal -->
 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Editar Reparación</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>
             <div class="modal-body">
                
             <form action="/templates/Reparaciones/ModificarReparacion.php" method='POST'>

                    <input type="hidden" name="areemplazar" value="<?php echo $areemplazar ?>">
                    
                    <div class="form-group">
                      <label for="cod_libro">Reemplazar x Libro</label>
                      <select class="form-control" name="cod_libro" id="cod_libro">
                          <?php while($libros2 = mysqli_fetch_assoc($resultado2)): ?>
                        <option value="<?php echo $libros2['cod_libro'] ?>"> <?php echo $libros2['cod_libro'] . " - " . $libros2['titulo'] ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
             
                    <div class="form-group">
                    <label for="fingreso">Fecha de ingreso</label>
                    <input type="date" readonly name="fingreso" id="fingreso" class="form-control" value="<?php echo $libros['fingreso']?>">
                    </div>
                    
                    <div class="form-group">
                    <label for="motivo">Motivo de ingreso</label>
                    <input type="text" readonly name="motivo" id="motivo" class="form-control" value="<?php echo $libros['motivo']?>">
                    </div>


                    </div>
                    <div class="modal-footer">
                        <a name="" id="" class="btn btn-secondary" href="/templates/Reparaciones/ListaReparacion.php" role="button">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
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