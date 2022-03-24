<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del cont principal-->
<div class="container">
    <h1>Gestion de Mesas</h1>



<?php
    include_once './bd/conexion.php';
    $db = $conn;

    $sql = "SELECT * FROM mesa";
    $result = $db->query($sql);

    $data = $result;
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevaMesa" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaMesa" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Capacidad</th>
                                <th>Disponibilidad</th>
                                <th>Acciones</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['numeroMesa'] ?></td>
                                <td><?php echo $dat['cantidadPersonas'] ?></td>
                                <td><?php echo $dat['disponibilidad'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div> 
    
    <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formMesa">    
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="capacidad" class="col-form-label">Capacidad:</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad" required>
                </div>                
                <div class="form-group">
                    <label for="disponibilidad" class="col-form-label">Disponibilidad:</label>
                    <input type="number" class="form-control" id="disponibilidad" name="disponibilidad" required>
                </div>           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>



