<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Gestion de Platillos</h1>



<?php
    include_once './bd/conexion.php';
    $db = $conn;

    $sql = "SELECT id, nombre, precio, tipo, detalles,imagen FROM platillos";
    $result = $db->query($sql);

    $data = $result;
    
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoPlatillo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPlatillos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>                                
                                <th>Tipo</th>  
                                <th>Detalles</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['precio']." $" ?></td>
                                <td><?php echo $dat['tipo'] ?></td>  
                                <td><?php echo $dat['detalles'] ?></td>
                                <td><img height="170px" width="250px" src="data:image/jpg;base64,<?php echo base64_encode($dat['imagen']);?>"></td>  
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
        <form id="formPlatillos">    
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="precio" class="col-form-label">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio" required>
                </div>                
                <div class="form-group">
                    <label for="tipo" class="col-form-label">Tipo:</label>
                    <input type="number" class="form-control" id="tipo" name="tipo" required>
                </div> 
                <div class="form-group">
                    <label for="detalles" class="col-form-label">Detalles:</label><br><br>
                    <textarea id ="detalles" name="detalles" rows="2" cols="40" required></textarea>
                </div>
                <div class="form-group" id="divImg">
                    <label for="imagen" class="col-form-label" id="imgLabel">Imagen:</label>
                    <input type="file" class="form-control form-control-lg" id="imagen" name="imagen" required>
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

