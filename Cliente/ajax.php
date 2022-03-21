<?php
    $action = $_GET['action'];
    include 'Cliente.php';
    $crud = new Action();

    if($action == 'logout'){
        $logout = $crud->logout();
        if($logout)
            echo $logout;
    }
?>