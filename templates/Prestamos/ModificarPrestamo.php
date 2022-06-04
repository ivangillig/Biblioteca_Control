<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $cod_registrado = $_POST['cod_registrado'];
    $cod_libro = $_POST['cod_libro'];
    $observaciones = $_POST['observaciones'];
    $cod_detalle = $_POST['cod_detalle'];
    $cod_prestamo = $_POST['cod_prestamo'];


    //Primero reemplazo el libro en la tabla detalle prestamo
    $query = "UPDATE detalleprestamo SET cod_libro = $cod_libro, observaciones='$observaciones' WHERE cod_libro = $cod_registrado";
    $resultado = mysqli_query(conectarDB(), $query);

    if($resultado){
        //Después devuelvo el libro que sale y lo pongo en biblioteca
        $query = "UPDATE libro SET estado = 'En biblioteca' WHERE cod_libro = $cod_registrado";
        $resultado = mysqli_query(conectarDB(), $query);

        if($resultado){
                //Por ultimo registro el nuevo libro como prestado
                $query = "UPDATE libro SET estado = 'Prestado' WHERE cod_libro = $cod_libro";
                $resultado = mysqli_query(conectarDB(), $query);

                if ($resultado){
                    header('Location: /templates/Prestamos/DetallePrestamo.php?id=' . $cod_prestamo);

                }else{ 
                    echo 'No se pudó cambiar el estado del libro a Prestado';
                }

        }else{
            echo 'No se pudó devolver el libro a la biblioteca';
        }

    }else{
        echo 'FALLÓ LA MODIFICACION DEL DETALLE';
    }
    


    // /templates/Prestamos/DetallePrestamo.php?id=<?php echo $res['cod_prestamo']
}

if(isset($_GET['id'])){

    $cod_detalle = $_GET['id'];

    $query = "SELECT * FROM detalleprestamo d JOIN libro l ON d.cod_libro = l.cod_libro WHERE cod_detalle = $cod_detalle ";
    $resultado = mysqli_query(conectarDB(), $query);
    $res = mysqli_fetch_assoc($resultado);


    include '../../Header.php';

if($resultado){
        ?>
        
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cambio de Libro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                    <form action="/templates/Prestamos/ModificarPrestamo.php" method="post">
                        <input type="hidden" name="cod_detalle" readonly class="form-control" value="<?php echo $cod_detalle ?>">
                            
                        <div class="form-group">
                        <label for="">Código de prestamo</label>
                        <input type="text" name="cod_prestamo" readonly id="" class="form-control" value="<?php echo $res['cod_prestamo'] ?>">
                        </div>

                        <div class="form-group">
                        <label for="">Libro Registrado</label>
                        <input type="hidden" name="cod_registrado" readonly  class="form-control" value="<?php echo $res['cod_libro'] ?>">
                        <input type="text" name="" readonly id="" class="form-control" value="<?php echo $res['titulo'] ?>">
                        </div>

                        <div class="form-group">
                        <label for="">Observaciones Registradas</label>
                        <textarea readonly class="form-control""><?php echo $res['observaciones'] ?> </textarea>
                        </div>

                        <?php 

                        $query2 = "SELECT cod_libro, titulo FROM libro WHERE estado = 'En biblioteca'";
                        $resultado2 = mysqli_query(conectarDB(), $query2);
                        
                        if ($resultado2){
                            ?>
                            <div class="form-group">
                            <label for="">Libro de Reemplazo</label>
                            <select class="form-control" name="cod_libro" id="">
                                    <?php while ($res2 = mysqli_fetch_assoc($resultado2)): ?>
                                    <option value="<?php echo $res2['cod_libro'] ?>"><?php echo $res2['titulo'] ?></option>
                                    <?php endwhile; ?>
                            </select>
                            </div>

                        <?php
                        }   else { echo 'Problemas en la consulta de libros';}              
                        ?>

                        <div class="form-group">
                        <label for="">Nuevas Observaciones</label>
                        <textarea name="observaciones" class="form-control""> </textarea>
                        </div>


                        </div>
                        <div class="modal-footer">
                            <a name="" id="" class="btn btn-primary" href="/templates/Prestamos/DetallePrestamo.php?id=<?php echo $res['cod_prestamo']?>" role="button">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php
    }else{
        echo 'VERIFICAR SQL';
    }
}

include '../../Footer.php';
?>