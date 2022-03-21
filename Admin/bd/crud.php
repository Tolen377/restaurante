<?php
include_once 'conexion.php';
$db = $conn;
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $id = uniqid();
        $sql = "INSERT INTO usuario VALUES('$id', '$nombre', '$email', '$password',2) ";			
        $resultado = $db->query($sql);
         

        $sql = "SELECT id, nombre, email, password,tipo FROM usuario WHERE id = '$id'";
        $resultado = $db->query($sql);

        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
              "id" => $row['id'],
              "nombre" => $row['nombre'],
              "email" => $row['email'],
              "password" => $row['password'],
              "tipo" => $row['tipo']
           );
        }
        $data = $response;
        break;

    case 2: //modificación
        $sql = "UPDATE usuario SET nombre='$nombre', email='$email', password='$password' WHERE id='$id' ";		
        $resultado = $db->query($sql);        
        
        $sql = "SELECT id, nombre, email, password,tipo FROM usuario WHERE id = '$id'";
        $resultado = $db->query($sql);

        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
              "id" => $row['id'],
              "nombre" => $row['nombre'],
              "email" => $row['email'],
              "password" => $row['password'],
              "tipo" => $row['tipo']
           );
        }
        $data = $response;
        break;    
    case 3://baja
        $sql = "DELETE FROM usuario WHERE id='$id' ";		
        $resultado = $db->query($sql);
        $data = $resultado;                           
        break;     
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

