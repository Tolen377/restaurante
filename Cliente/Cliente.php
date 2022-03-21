<?php
    Class Action {
        private $db;

        public function __construct() {
            include '../db_connect.php';
            $this->db = $conn;
        }


        function __destruct() {
            $this->db->close();
        }

        function logout(){
            session_start();
            session_destroy();
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            header("location:../index.php");
        }
    }
?>