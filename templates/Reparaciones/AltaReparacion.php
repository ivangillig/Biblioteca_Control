<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();
     
if(!$auth){

    header('Location: /');
}

//query para traer la tabla completa
$query = "SELECT cod_libro, titulo FROM libro WHERE estado = 'En biblioteca'";

//hago la consulta
$resultado = mysqli_query(conectarDB(), $query);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


        $cod_libro = $_POST['cod_libro'];
        $fingreso = $_POST['fingreso'];
        $motivo = $_POST['motivo'];

        //Creo el query para insertar
        $query = "INSERT INTO reparacion (cod_libro, fingreso, motivo) VALUES ('$cod_libro', '$fingreso', '$motivo')";
        $cambiarEstado = "UPDATE libro SET estado = 'En reparación' WHERE cod_libro = $cod_libro";

        //insertar en la DB
        $resultado = mysqli_query(conectarDB(), $query);
        $resultado2 = mysqli_query(conectarDB(), $cambiarEstado);

        if($resultado && $resultado2){
            //Redireccionar al usuario.
            header('Location: /templates/Reparaciones/ListaReparacion.php');
        }else{
            echo 'Revisar SQL';
        }

}

include '../../Header.php';
if($resultado){
    

?>
 
 <!-- Modal -->
 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Ingreso a Reparación</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>
             <div class="modal-body">
                
             <form action="/templates/Reparaciones/AltaReparacion.php" method='POST'>
                    
                    <div class="form-group">
                      <label for="cod_libro">Libro</label>
                      <select class="form-control" name="cod_libro" id="cod_libro">
                          <?php while($libros = mysqli_fetch_assoc($resultado)): ?>
                        <option value="<?php echo $libros['cod_libro'] ?>"> <?php echo $libros['cod_libro'] . " - " . $libros['titulo'] ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
             
                    <div class="form-group">
                    <label for="fingreso">Fecha de ingreso</label>
                    <input type="date" name="fingreso" id="fingreso" class="form-control">
                    </div>
                    
                    <div class="form-group">
                    <label for="motivo">Motivo de ingreso</label>
                    <input type="text" name="motivo" id="motivo" class="form-control" placeholder="Ingrese un motivo">
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





<?php }
include '../../Footer.php';
?>