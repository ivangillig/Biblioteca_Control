<?php include '../../config/funciones.php';
      include '../../config/database.php';

      //include '../../Header.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $cod_socio = $_POST['cod_socio'];
    $nomyape = $_POST['nomyape'];
    $fnacimiento = $_POST['fnacimiento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];


    $query = "UPDATE socio SET nomyape='$nomyape', fnacimiento='$fnacimiento', direccion='$direccion', telefono='$telefono', email='$email' WHERE cod_socio = $cod_socio";
    $resultado = mysqli_query(conectarDB(), $query);

    if($resultado){
        header('Location: /templates/Socios/ListaSocio.php');
    }else{
        echo 'Falló al intentar actualizar el socio';
    }

}

include '../../Header.php';
if(isset($_GET['id'])){

    $cod_socio = $_GET['id'];

    $query = "SELECT * FROM socio WHERE cod_socio = $cod_socio";
    $resultado = mysqli_query(conectarDB(), $query);
    $res = mysqli_fetch_assoc($resultado);

    if($resultado){
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modificar Socio</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            
                        <form action="/templates/Socios/ModificarSocio.php" method='POST'>

                                <input type="hidden" name="cod_socio" class="form-control" value="<?php echo $cod_socio ?>">

                                <div class="form-group">
                                <label for="nomyape">Nombre y Apellido</label>
                                <input type="text" name="nomyape" id="nomyape" class="form-control" value="<?php echo $res['nomyape'] ?>">
                                </div>

                                <div class="form-group">
                                <label for="fnacimiento">Fecha de nacimiento</label>
                                <input type="date" name="fnacimiento" id="fnacimiento" class="form-control" value="<?php echo $res['fnacimiento'] ?>">
                                </div>

                                <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $res['direccion'] ?>">
                                </div>

                                

                                <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $res['telefono'] ?>">
                                </div>
                                
                                <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $res['email'] ?>">
                                </div>
                        

                                </div>
                                <div class="modal-footer">
                                    <a name="" id="" class="btn btn-secondary" href="/templates/Socios/ListaSocio.php" role="button">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php
    }
}



include '../../Footer.php';
?>