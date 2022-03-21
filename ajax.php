<?php
$action = $_GET['action'];
include 'visitante.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}

if($action == 'registrar'){
	$logout = $crud->registrar();
	if($logout)
		echo $logout;
}
?>


