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

    function altaPlatillo($nombre,$precio,$tipo,$detalles){
        $id = uniqid();
        $sql = "INSERT INTO platillos (id,nombre,precio,tipo,detalles) VALUES('$id', '$nombre', '$precio',1, '$detalles')";			
        $resultado = $this->db->query($sql);

        $sql = "SELECT id,nombre,precio,tipo,detalles FROM platillos WHERE id = '$id'";
        $resultado = $this->db->query($sql);

        $response = array();
        while($row = mysqli_fetch_assoc($resultado)){
           $response[] = array(
              "id" => $row['id'],
              "nombre" => $row['nombre'],
              "precio" => $row['precio'],
              "tipo" => $row['tipo'],
              "detalles" => $row['detalles']
           );
        }
        return $response;
    }
}