<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}

include '../../Header.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $estado = $_POST['estado'];

        if ($estado == 'Prestado'){
        $query = "SELECT * FROM libro l JOIN detalleprestamo d ON l.cod_libro = d.cod_libro JOIN prestamo p ON d.cod_prestamo = p.cod_prestamo JOIN socio s ON p.cod_socio = s.cod_socio WHERE l.estado = 'Prestado' AND p.fecha_devolucion IS NULL";
        }else{
        //traigo todos los libros en prestamos vigentes para cierto socio
        $query = "SELECT * FROM libro WHERE estado = '$estado'";
        }

        //hago la consulta
        $resultado = mysqli_query(conectarDB(), $query);


        
        if ($resultado) {

        ?>
            
            <div class="container mt-4">
            <h2>Listado de libros por estado</h2>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Cod. Libro</th>
                            <th>Título</th>
                            <th>Editorial</th>
                            <th>Fecha Edición</th>
                            <th>Idioma</th>
                            <th>Cant. Páginas</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rep = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?php echo $rep['cod_libro'] ?></td>
                            <td><?php echo $rep['titulo'] ?></td>
                            <td><?php echo $rep['editorial'] ?></td>
                            <td><?php echo $rep['fedicion'] ?></td>
                            <td><?php echo $rep['idioma'] ?></td>
                            <td><?php echo $rep['cantpaginas'] ?></td>

                            <!-- SI está prestado, pongo el nombre de quien lo tiene con un ternario -->
                            <td><?php echo ($rep['estado']=='Prestado') ? $rep['estado']." a ".$rep['nomyape'] : $rep['estado'] ?></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>

        <?php }else{echo 'REVISAR SQL';}
    }

   
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
?>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Listar libros por estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <form action="/templates/Libros/LibrosPorEstado.php" method="post">
                
                <div class="form-group">
                  <label for="">Seleccione un estado</label>
                  <select class="form-control" name="estado" id="">
                    <option value="En biblioteca">En biblioteca</option>
                    <option value="En reparación">En reparación</option>
                    <option value="Prestado">Prestado</option>
                  </select>
                </div>

            </div>
            <div class="modal-footer">
                <a name="" id="" class="btn btn-primary" href="/templates/Libros/ListaLibros.php" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
            </form>
        </div>
    </div>
</div>



<?php
}

include '../../Footer.php';

?>