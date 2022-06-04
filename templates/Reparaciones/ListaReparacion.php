<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}


//query para traer la tabla completa
$query = "SELECT * FROM reparacion r JOIN libro l ON r.cod_libro = l.cod_libro WHERE fegreso is NULL";

//hago la consulta
$resultado = mysqli_query(conectarDB(), $query);

include '../../Header.php';

if($resultado){

?>

<div class="container mt-4">
    <h2>Listado de reparaciones vigentes</h2>
    <table class="table mt-4"">
        <thead>
            <tr>
                <th>Fecha ingreso</th>
                <th>id - Libro</th>
                <th>Motivo de ingreso</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($rep = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $rep['fingreso'] ?></td>
                <td><?php echo $rep['cod_libro'] . " - " . $rep['titulo'] ?></td>
                <td><?php echo $rep['motivo'] ?></td>
                <td>
                <a name="" id="" class="btn btn-primary" href="ModificarReparacion.php?id=<?php echo $rep['cod_libro']?>" role="button">Editar</a>
                <a name="" id="" class="btn btn-danger" href="BajaReparacion.php?id=<?php echo $rep['cod_libro']?>" role="button">Baja</a>

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