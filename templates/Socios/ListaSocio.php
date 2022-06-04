<?php include '../../config/funciones.php';
      include '../../config/database.php';


//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}


//query para traer la tabla completa
$query = "SELECT * FROM socio";

//hago la consulta
$resultado = mysqli_query(conectarDB(), $query);

if($resultado){


    include '../../Header.php';

?>

<div class="container mt-4">
<h2>Listado de Socios</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID Socio</th>
                <th>Nombre y Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th class="col-sm-2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($rep = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $rep['cod_socio'] ?></td>
                <td class="col-sm-2"><?php echo $rep['nomyape'] ?></td>
                <td><?php echo $rep['fnacimiento'] ?></td>
                <td class="col-sm-2"><?php echo $rep['direccion'] ?></td>
                <td><?php echo $rep['telefono'] ?></td>
                <td><?php echo $rep['email'] ?></td>
                <td >
                <a name="" id="" class="btn btn-primary " href="ModificarSocio.php?id=<?php echo $rep['cod_socio']?>" role="button">Modificar</a>
                <a name="" id="" class="btn btn-danger " href="BajaSocio.php?id=<?php echo $rep['cod_socio']?>" role="button">Baja</a>

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