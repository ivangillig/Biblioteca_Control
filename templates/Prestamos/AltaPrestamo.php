<?php include '../../config/funciones.php';
      include '../../config/database.php';

//Verifico que el usuario esté autenticado
$auth = estaAutenticado();
if(!$auth){
    header('Location: /');
}

    //Consulto si estoy agregando otro libro a un prestamo
     if (isset($_GET['fun'])){
        
         $ultimoPrestamo = ultimoPrestamo();

         $query = "SELECT * FROM prestamo p JOIN socio s ON p.cod_socio = s.cod_socio WHERE cod_prestamo = $ultimoPrestamo";
         $resultado2 = mysqli_query(conectarDB(), $query);

         
         $res = mysqli_fetch_assoc($resultado2);

     }else{
            //query para cargar el form con los libros y socios
            
            $query2 = "SELECT cod_socio, nomyape FROM socio";
            
            $resultado2 = mysqli_query(conectarDB(), $query2);
            }
    


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Consulto si es un prestamo nuevo o si estoy agregando libros
        if (!isset($_POST['ultimoPrestamo'])){

            $cod_socio = $_POST['cod_socio'];
            $fecha_prestamo = $_POST['fecha_prestamo'];

            //Creo el query para insertar
            $query = "INSERT INTO prestamo (cod_socio, fecha_prestamo) VALUES ('$cod_socio', '$fecha_prestamo')";

            //insertar en la DB
            $resultado = mysqli_query(conectarDB(), $query);
           
    
        }else{
            $ultimoPrestamo = $_POST['ultimoPrestamo'];
        }

        //Cambio el estado del libro a prestado->
        $cod_libro = $_POST['cod_libro'];
        $observacion = $_POST['observacion'];
        $cambiarEstado = "UPDATE libro SET estado = 'Prestado' WHERE cod_libro = $cod_libro";
        $resultado2 = mysqli_query(conectarDB(), $cambiarEstado);

        if(($resultado && $resultado2) || $ultimoPrestamo){

        //Consulto cual fue el último prestamo y lo inserto en el nuevo detalle
        $lastid = ultimoPrestamo();

        $query = "INSERT INTO detalleprestamo (cod_prestamo, cod_libro, observaciones) VALUES ('$lastid', '$cod_libro', '$observacion')";
        
        //hago la consulta
        $resultado2 = mysqli_query(conectarDB(), $query);

        if($resultado2){
            
            if(isset($_POST['agregarOtro'])){
                header('Location: /templates/Prestamos/AltaPrestamo.php?fun=add');
            }else{
                //Redireccionar al usuario.
                header('Location: /templates/Prestamos/ListaPrestamos.php');
            }
        }else{
            echo 'Revisar SQL';
        }

        }else{
        echo 'Revisar SQL';
        }

        }

    //me traigo los libros disponibles para prestar
    $query = "SELECT cod_libro, titulo FROM libro WHERE estado = 'En biblioteca'";
    //hago la consulta
    $resultado = mysqli_query(conectarDB(), $query);


include '../../Header.php';

if($resultado && $resultado2){
    

?>
 
 <!-- Modal -->
 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Nuevo Prestamo</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>
             <div class="modal-body">
                
             <form action="/templates/Prestamos/AltaPrestamo.php" method='POST'>

                    <?php if (isset($_GET['fun'])){ ?>
                    <div class="form-group">
                      <input type="hidden" class="form-control" value="<?php echo ultimoPrestamo(); ?>" name="ultimoPrestamo" id="">
                    </div>
                    <?php }?>
                    
                    <div class="form-group">
                      <label for="cod_socio">Socio</label>
                      <select class="form-control"  name="cod_socio" id="cod_socio" <?php echo isset($_GET['fun']) ? 'readonly' : '' ?>>
                          
                      <?php if (isset($_GET['fun'])){ ?>
                              <option value="<?php echo $res['cod_socio'] ?>"> <?php echo $res['cod_socio'] . " - " . $res['nomyape'] ?></option>
                           
                       <?php } else {  while($socios = mysqli_fetch_assoc($resultado2)): ?>
                        <option value="<?php echo $socios['cod_socio'] ?>"> <?php echo $socios['cod_socio'] . " - " . $socios['nomyape'] ?></option>
                        <?php endwhile;} ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                    <label for="fecha_prestamo">Fecha de Prestamo</label>
                    <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" <?php echo isset($_GET['fun']) ? 'readonly' : '' ?> value="<?php if (isset($_GET['fun'])){ echo $res['fecha_prestamo']; }?>" >
                    </div>
                    
                    <div class="form-group">
                      <label for="cod_libro">Libro</label>
                      <select class="form-control" name="cod_libro" id="cod_libro">
                          <?php while($libros = mysqli_fetch_assoc($resultado)): ?>
                        <option value="<?php echo $libros['cod_libro'] ?>"> <?php echo $libros['cod_libro'] . " - " . $libros['titulo'] ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="observacion">Observaciones</label>
                      <textarea class="form-control" name="observacion" id="observacion" rows="3"></textarea>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" name="agregarOtro" class="btn btn-primary">Guardar y agregar otro</button>

                    <?php if (!isset($_GET['fun'])){?>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <?php }?>
                    
                    <?php if (isset($_GET['fun'])){?>
                    <a name="" id="" class="btn btn-danger" href="/templates/Prestamos/ListaPrestamos.php" role="button">Terminé!</a>
                    <?php }else{?>
                    <a name="" id="" class="btn btn-secondary" href="/templates/Prestamos/ListaPrestamos.php" role="button">Cancelar</a>
                    <?php }?>

                    </div>
             </form>
         </div>
     </div>
 </div>





<?php }
include '../../Footer.php';



function ultimoPrestamo(){
    //query para traer la tabla completa
    $query = "SELECT MAX(cod_prestamo) as cod_prestamo FROM prestamo";
        
    //hago la consulta
    $resultado = mysqli_query(conectarDB(), $query);

    $lastid = mysqli_fetch_assoc($resultado);

    return $lastid['cod_prestamo'];
}

?>