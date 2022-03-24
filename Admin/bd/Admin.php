<?php
Class Action {
    private $db;

	public function __construct() {
        include_once './conexion.php';
		$this->db = $conn;
	}

    function __destruct() {
        $this->db->close();
	   
	}

    function altaPlatillo($nombre,$precio,$tipo,$detalles,$bin){
        $id = uniqid();
        $sql = "INSERT INTO platillos (id,nombre,precio,tipo,detalles,imagen) VALUES('$id', '$nombre', '$precio',1, '$detalles','$bin')";			
        $resultado = $this->db->query($sql);

        $sql = "SELECT id,nombre,precio,tipo,detalles,imagen FROM platillos WHERE id = '$id'";
        $resultado = $this->db->query($sql);

        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
              "id" => $row['id'],
              "nombre" => $row['nombre'],
              "precio" => $row['precio'],
              "tipo" => $row['tipo'],
              "detalles" => $row['detalles'],
              "imagen" => base64_encode($row['imagen'])
           );
        }
        return $response;
    }

    function borrarPlatillo() {
        extract($_POST);
        $sql = "DELETE FROM platillos WHERE id='$id';";		
        $resultado = $this->db->query($sql);
        return $resultado;

    }

    function editarPlatillo($id,$nombre,$precio,$tipo, $detalles) {
        $sql = "UPDATE platillos SET nombre = '$nombre', precio = '$precio', tipo = '$tipo', detalles = '$detalles' WHERE id = '$id'";
        $resultado = $this->db->query($sql);

        $sql = "SELECT * FROM platillos WHERE id = '$id'";
        $resultado = $this->db->query($sql);

        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
              "id" => $row['id'],
              "nombre" => $row['nombre'],
              "precio" => $row['precio'],
              "tipo" => $row['tipo'],
              "detalles" => $row['detalles'],
              "imagen" => base64_encode($row['imagen'])
           );
        }
        return $response; 
    }

    function altaMesa() {
        extract($_POST);
        $id = uniqid();
        $sql = "INSERT INTO mesa VALUES ('$id','$capacidad','$disponibilidad');";		
        $resultado = $this->db->query($sql);

        $sql = "SELECT * FROM mesa WHERE numeroMesa = '$id';";
        $resultado = $this->db->query($sql);
        
        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
              "id" => $row['numeroMesa'],
              "capacidad" => $row['cantidadPersonas'],
              "disponibilidad" => $row['disponibilidad']
           );
        }
        return $response; 
    }

    function editarMesa($id) {
        extract($_POST);
        $sql = "UPDATE mesa SET cantidadPersonas='$capacidad', disponibilidad='$disponibilidad' WHERE numeroMesa='$id';";		
        $resultado = $this->db->query($sql);        
        
        $sql = "SELECT * FROM mesa WHERE numeroMesa = '$id'";
        $resultado = $this->db->query($sql);

        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
            "id" => $row['numeroMesa'],
            "capacidad" => $row['cantidadPersonas'],
            "disponibilidad" => $row['disponibilidad']
           );
        }
        return $response;
    }

    function borrarMesa() {
        extract($_POST);
        $sql = "DELETE FROM mesa WHERE numeroMesa='$id';";		
        $resultado = $this->db->query($sql);
        return $resultado;
    }
}


