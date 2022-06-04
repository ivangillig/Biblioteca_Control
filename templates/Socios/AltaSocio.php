<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();
     
if(!$auth){

    header('Location: /');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){


$nomyape = $_POST['nomyape'];
$fnacimiento = $_POST['fnacimiento'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

//Creo el query para insertar
$query = "INSERT INTO socio (nomyape, fnacimiento, direccion, telefono, email) VALUES ('$nomyape', '$fnacimiento', '$direccion', '$telefono', '$email')";
// var_dump($query);
// return;

//insertar en la DB
$resultado = mysqli_query(conectarDB(), $query);

if($resultado){
    //Redireccionar al usuario.
    header('Location: /templates/Socios/ListaSocio.php');
}else{
    echo 'Revisar SQL';
}

}


include '../../Header.php';
?>
 
 <!-- Modal -->
 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Alta de Nuevo Socio</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>
             <div class="modal-body">
                
             <form action="/templates/Socios/AltaSocio.php" method='POST'>
                    <div class="form-group">
                    <label for="nomyape">Nombre y Apellido</label>
                    <input type="text" name="nomyape" id="nomyape" class="form-control" placeholder="Ingrese un Nombre y Apellido">
                    </div>

                    <div class="form-group">
                    <label for="fnacimiento">Fecha de nacimiento</label>
                    <input type="date" name="fnacimiento" id="fnacimiento" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese una dirección">
                    </div>

                    

                    <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese un número de teléfono">
                    </div>
                    
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese una direcicón de email">
                    </div>
            

                    </div>
                    <div class="modal-footer">
                        <a name="" id="" class="btn btn-secondary" href="/templates/Socios/ListaSocio.php" role="button">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
             </form>
         </div>
     </div>
 </div>





<?php
include '../../Footer.php';
?>