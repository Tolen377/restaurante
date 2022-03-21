<?php include './Includes/header.php';?>
	<!-- Content -->
	<div class="container container-web-page">
	    <h3 class="font-weight-bold poppins-regular text-uppercase">Crear cuenta</h3>
	    <hr>
	    <div class="row">
	        <div class="col-12">
	            <form id="registro-form" class="div-bordered" style="padding: 15px;">
	                <fieldset>
	                    <legend><i class="fas fa-user-lock"></i> &nbsp; Ingrese la información</legend>
	                    <div class="container-fluid">
	                        <div class="row">
	                            <div class="col-12 col-md-4">
	                                <div class="form-outline mb-4">
	                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="47" required>
	                                    <label for="nombre" class="form-label">Nombre completo</label>
	                                </div>
	                            </div>
								
								<!--------------------------------------------------------------------------------->
								
								<div class="col-12 col-md-4">
	                                <div class="form-outline mb-4">
	                                    <input type="email" class="form-control" name="email" id="email" maxlength="47" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
	                                    <label for="email" class="form-label">Email</label>
	                                </div>
	                            </div>
	                            <div class="col-12 col-md-4">
	                                <div class="form-outline mb-4">
	                                    <input type="password" class="form-control" name="password" id="password" maxlength="30" required >
	                                    <label for="password" class="form-label">Password</label>
	                                </div>
	                            </div>
								<div class="col-12 col-md-4">
	                                <div class="form-outline mb-4">
	                                    <input type="password" class="form-control" name="passwordV" id="passwordV" maxlength="30" required >
	                                    <label for="password" class="form-label">Verifique el password</label>
	                                </div>
	                            </div>
								<div id="error" class="alert alert-danger ocultar" role="alert">
    								Las Contraseñas no coinciden, vuelve a intentar !
								</div>
	                        </div>
	                    </div>
	                </fieldset>

	                <p class="text-center" style="margin-top: 40px;">
	                    <button type="submit" class="btn btn-info btn-sm"><i class="far fa-paper-plane"></i> &nbsp; CREAR CUENTA</button>
	                </p>
	            </form>
	        </div>
	    </div>
	</div>
<?php include './Includes/footer.php';?>
