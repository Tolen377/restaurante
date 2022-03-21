<?php
Class Action {
	private $db;

	public function __construct() {
		include 'db_connect.php';
		$this->db = $conn;
	}

	function __destruct() {
	    $this->db->close();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM usuario where email = '".$email."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			session_start();
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}else{
			return 2;
		}
	}

	function validar($email) {
		$save = $this->db->query("SELECT * FROM usuario WHERE email = '$email'");
		return $rows = mysqli_num_rows($save);
	}

	function registrar(){
		extract($_POST);
		
		if ($this->validar($email) > 0)
			return 0;
		
		$tipo = 2;
		$data = "id = '".uniqid()."'";
		$data .= ", nombre = '".$nombre."' ";
		$data .= ", email = '".$email."' ";
		$data .= ", password = '".$password."' ";
		$data .= ", tipo = '".$tipo."' ";

		$save = $this->db->query("INSERT INTO usuario set ". $data);
		if($save)
			return 1;
	}
}	
?>
