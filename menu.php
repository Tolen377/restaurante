<?php include './Includes/header.php';?>
<?php
    include 'db_connect.php';
    $db = $conn;

    $sql = "SELECT nombre,precio,detalles,imagen FROM platillos";
    $result = $db->query($sql);

    $data = $result;
    
?>
	<!-- Content -->
	<div class="container container-web-page">
	    <h3 class="font-weight-bold poppins-regular text-uppercase">Menú de platillos</h3>
	    <p class="text-justify">Bienvenido al menú de platillos, acá encontrara todos los platillos disponibles en el restaurante.</p>
	    <div class="container-cards full-box" style="padding-bottom: 40px;">
		<?php                            
        foreach($data as $dat) {                                                        
        ?>
			<div class="card shadow-1-strong">
				<img class="card-img-top" src="data:image/jpg;base64,<?php echo base64_encode($dat['imagen']);?>" alt="nombre_platillo">
				<div class="card-body text-center">
					<h5 class="card-title font-weight-bold"><?php echo $dat['nombre'] ?></h5>
					<p class="card-text lead"><span class="badge bg-secondary"><?php echo $dat['precio'] .' $' ?></span></p>
				</div>

				<div class="card-body text-center">
						<p><?php echo $dat['detalles'] ?></p>
				</div>
			</div>         
        <?php
        }
    	?>
	    </div>
	</div>
<?php include './Includes/footer.php';?>	