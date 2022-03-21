<?php 
	session_start();
	if(isset($_SESSION['login_id'])) {
		if ($_SESSION['login_tipo'] == 1) 
			header("location: Admin/index.php");
		elseif ($_SESSION['login_tipo'] == 2) 
			header("location: Cliente/index.php");	
	}
		
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Restaurant</title>

	<link rel="stylesheet" href="./css/normalize.css">
	<link rel="stylesheet" href="./css/mdb.min.css">
	<link rel="stylesheet" href="./css/all.css">
	<script src="./js/sweetalert2.js" ></script>
	<link rel="stylesheet" href="./css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>

	<!-- Header -->
	<header class="header full-box">
	    <div class="header-options full-box">
	        <nav class="header-navbar full-box poppins-regular font-weight-bold" >
	            <ul class="list-unstyled full-box">
	                <li>
	                    <a href="index.php" >Inicio<span class="full-box" ></span></a>
	                </li>
	                <li>
	                    <a href="menu.php" >Menú<span class="full-box" ></span></a>
	                </li>
	            </ul>
	        </nav>
	        <div class="header-button full-box text-center btn-login-menu" >
	            <i class="fas fa-user-alt" onclick="show_popup_login()" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Login" ></i>
	            <div class="div-bordered popup-login">

	                <!-- Inicio de sesion -->
	                <span class="text-center poppins-regular font-weight-bold">Inicio de sesión</span>
	                <form id="login-form" class="full-box" action="">
	                    <div class="form-outline mb-4">
	                        <input type="email" class="form-control" name="email" id="login_email" maxlength="70" required="" placeholder="Email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" >
	                    </div>
	                    <div class="form-outline mb-4">
	                        <input type="password" class="form-control" name="password" id="login_password" maxlength="" required="" placeholder="Contraseña" >
	                    </div>
	                    <p class="text-center">
	                        <button class="btn btn-info btn-sm w-100">Iniciar sesión</button>
	                    </p>
	                </form>
	                <hr>
	                <p class="text-center full-box">¿No tienes cuenta? <a href="registration.php">Regístrate aquí</a></p>
	            </div>
	        </div>
	        <a href="bag.php" class="header-button full-box text-center" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Carrito" >
	            <i class="fas fa-shopping-bag"></i>
	            <span class="badge bg-warning rounded-pill bag-count" >2</span>
	        </a>
	    </div>
	</header>

