<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /login.php');
}

if (isset($_GET['id'])) {
    $cod_prestamo = $_GET['id'];

    if (is_numeric($cod_prestamo)) {

        //query para traer la tabla completa
        $query = "SELECT * FROM prestamo p JOIN socio s ON p.cod_socio = s.cod_socio WHERE p.cod_prestamo = $cod_prestamo";

        //hago la consulta
        $resultado = mysqli_query(conectarDB(), $query);

        $pres = mysqli_fetch_assoc($resultado);
    } else {
        header('Location: /templates/Prestamos/ListaPrestamos.php');
    }
}

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $cod_prestamo = $_POST['cod_prestamo'];
        $cod_socio = $_POST['cod_socio'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $fecha_devolucion = $_POST['fecha_devolucion'];

        //PRIMERO DAMOS POR DEVUELTO EL PRESTAMO CON FECHA DE DEVOLUCION
        $query = "UPDATE prestamo SET fecha_devolucion = '$fecha_devolucion' WHERE cod_prestamo = $cod_prestamo";
        $resultado1 = mysqli_query(conectarDB(), $query);

        //SEGUNDO CAMBIAMOS EL ESTADO DE LOS LIBROS DE X PRESTAMO A "EN BIBLIOTECA"
        $query = "UPDATE libro l INNER JOIN detalleprestamo d ON l.cod_libro = d.cod_libro SET estado = 'En biblioteca'  WHERE d.cod_prestamo = $cod_prestamo";
        $resultado2 = mysqli_query(conectarDB(), $query);
        
        if ($resultado1 && $resultado2) {
            header('Location: /templates/Prestamos/ListaPrestamos.php');
        }else{
            echo 'RevisarSQL';
        }
        
    }

include '../../Header.php';

if ($resultado){

?>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Devolución de Préstamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="/templates/Prestamos/BajaPrestamo.php" method="POST">
                        <div class="form-group">
                            <label for="cod_prestamo">ID Pestamo</label>
                            <input type="text" readonly name="cod_prestamo" id="" class="form-control" value="<?php echo $pres['cod_prestamo'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="">ID Socio</label>
                            <input type="hidden" name="cod_socio" id="" class="form-control" value="<?php echo $pres['cod_socio'] ?>">
                            <input type="text" readonly class="form-control" value="<?php echo $pres['cod_socio'] . " - " . $pres['nomyape'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="fecha_prestamo">Fecha de Préstamo</label>
                            <input type="date" readonly name="fecha_prestamo" id="" class="form-control" value="<?php echo $pres['fecha_prestamo'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="fecha_devolucion">Fecha de Devolución</label>
                            <input type="date" min="<?php echo $pres['fecha_prestamo'] ?>" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value""">
                        </div>

                </div>

                <div class="modal-footer">
                    <a name="" id="" class="btn btn-primary" href="/templates/Prestamos/ListaPrestamos.php" role="button">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Dar de baja!</button>
                </div>

                </form>
            </div>
        </div>
    </div>





<?php }
include '../../Footer.php';
?>