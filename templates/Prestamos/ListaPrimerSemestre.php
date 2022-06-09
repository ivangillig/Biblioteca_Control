<?php 
      include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();

if(!$auth){
    header('Location: /login.php');
}


        //traigo todos los libros en prestamos vigentes para cierto socio
        $query = "SELECT * FROM detalleprestamo d JOIN prestamo p ON d.cod_prestamo = p.cod_prestamo JOIN libro l ON d.cod_libro = l.cod_libro JOIN socio s ON p.cod_socio = s.cod_socio WHERE p.fecha_devolucion IS NULL AND month(p.fecha_prestamo) > 1 AND month(p.fecha_prestamo) < 7";
        
        //hago la consulta
        $resultado = mysqli_query(conectarDB(), $query);

        include '../../Header.php';
        if ($resultado) {

        ?>
            
            <div class="container mt-4">
            <h2>Libros solicitados por menores de edad</h2>
            <table class="table mt-4" >
                <thead>
                    <tr>
                        <th>ID Prestamo</th>
                        <th>Fecha Prestamo</th>
                        <th>Fecha Devolución</th>
                        <th>Libro</th>
                        <th>Socio</th>
                        <th>Fecha Nacimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($rep = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $rep['cod_prestamo'] ?></td>
                        <td><?php echo $rep['fecha_prestamo'] ?></td>
                        <td><?php echo $rep['fecha_devolucion'] ? $rep['fecha_devolucion'] : 'Pendiente' ?></td>
                        <td><?php echo $rep['titulo'] ?></td>
                        <td><?php echo $rep['nomyape'] ?></td>
                        <td><?php echo $rep['fnacimiento'] ?></td>
                        
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            </div>

        <?php }else{echo 'REVISAR SQL';}
    

include '../../Footer.php';

?>