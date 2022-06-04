<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}

if(isset($_GET['id'])){

    $cod_prestamo = $_GET['id'];

    //Me traigo todos los libros del prestamo [ID]
    $query = "SELECT * FROM prestamo p JOIN detalleprestamo d ON p.cod_prestamo = d.cod_prestamo JOIN socio s ON p.cod_socio = s.cod_socio JOIN libro l ON d.cod_libro = l.cod_libro WHERE p.cod_prestamo = $cod_prestamo";
    $resultado = mysqli_query(conectarDB(), $query);


include '../../Header.php';

    if($resultado){



        ?>
        <div class="container mt-4">

        <h3>Detalles del Prestamo con ID: <?php echo $cod_prestamo ?></h3>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Fecha de prestamo</th>
                    <th>Socio</th>
                    <th>Libro</th>
                    <th>Observaciones</th>
                    <th>Editar detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($res = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td> <?php echo $res['fecha_prestamo'] ?></td>
                    <td> <?php echo $res['cod_socio'] . " - " . $res['nomyape'] ?></td>
                    <td> <?php echo $res['cod_libro'] . " - " . $res['titulo'] ?></td>
                    <td> <?php echo $res['observaciones'] ?></td>
                    <td>  
                        <a name="" id="" class="btn btn-primary w-100" href="/templates/Prestamos/ModificarPrestamo.php?id=<?php echo $res['cod_detalle'] ?>" role="button">Editar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
        <?php
    }
}



include '../../Footer.php';
?>