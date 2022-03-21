<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $id = uniqid();
        $consulta = "INSERT INTO usuario VALUES('$id', '$nombre', '$email', '$password',2) ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, email, password,tipo FROM usuario WHERE id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //modificación
        $consulta = "UPDATE usuario SET nombre='$nombre', email='$email', password='$password' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, email, password,tipo FROM usuario WHERE id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;     
    case 3://baja
        $consulta = "DELETE FROM usuario WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $data = $resultado->execute();                           
        break;       
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
