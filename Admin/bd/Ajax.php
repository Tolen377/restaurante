<?php
    $action = $_GET['action'];
    include 'Admin.php';
    $crud = new Action();

    if($action == 'altaPlatillo'){
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];
        $detalles = $_POST['detalles'];
        //$bin = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $altaPlatillo = $crud->altaPlatillo($nombre,$precio,$tipo,$detalles);
        if($altaPlatillo)
            print json_encode($altaPlatillo, JSON_UNESCAPED_UNICODE);

    }


