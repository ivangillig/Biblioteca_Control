<?php include '../../config/funciones.php';
      include '../../config/database.php';

      
//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}


//query para traer la tabla completa
$query = "SELECT * FROM prestamo p JOIN socio s ON p.cod_socio = s.cod_socio WHERE p.fecha_devolucion is NULL";

//hago la consulta
$resultado = mysqli_query(conectarDB(), $query);

include '../../Header.php';

if($resultado){

?>

<div class="container w-50 mt-4">
<h2>Listado de prestamos vigentes</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID Prestamo</th>
                <th>Socio</th>
                <th>Fecha Prestamo</th>
                <th class="col-sm-3">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($rep = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $rep['cod_prestamo'] ?></td>
                <td><?php echo $rep['cod_socio'] . " - " . $rep['nomyape'] ?></td>
                <td><?php echo $rep['fecha_prestamo'] ?></td>
                <td>
                <a name="" id="" class="btn btn-primary" href="DetallePrestamo.php?id=<?php echo $rep['cod_prestamo']?>" role="button">Detalles</a>
                <a name="" id="" class="btn btn-danger" href="BajaPrestamo.php?id=<?php echo $rep['cod_prestamo']?>" role="button">Devolución</a>

                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>


<?php
}

include '../../Footer.php';

?>