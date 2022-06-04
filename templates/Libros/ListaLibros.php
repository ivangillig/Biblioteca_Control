<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}


//query para traer la tabla completa
$query = "SELECT * FROM libro";

//hago la consulta
$resultado = mysqli_query(conectarDB(), $query);

include '../../Header.php';
if($resultado){

?>

<div class="container mt-4">
<h2>Listado de libros</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Cod. Libro</th>
                <th>Título</th>
                <th>Editorial</th>
                <th>Fecha Edición</th>
                <th>Idioma</th>
                <th>Cant. Páginas</th>
                <th>Opciones</th>
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
                <td >
                <a name="" id="" class="btn btn-primary " href="ModificarLibro.php?id=<?php echo $rep['cod_libro']?>" role="button">Modificar</a>
                <a name="" id="" class="btn btn-danger " href="BajaLibro.php?id=<?php echo $rep['cod_libro']?>" role="button">Baja</a>
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