<?php
    $action = $_GET['action'];
    include 'Admin.php';
    $crud = new Action();

    if($action == 'altaPlatillo'){
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];
        $detalles = $_POST['detalles'];
        $bin = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $altaPlatillo = $crud->altaPlatillo($nombre,$precio,$tipo,$detalles,$bin);
        if($altaPlatillo)
            print json_encode($altaPlatillo, JSON_UNESCAPED_UNICODE);
    }

    if($action == 'borrarPlatillo'){
        $borrarPlatillo = $crud->borrarPlatillo();
        if ($borrarPlatillo)
            print json_encode($borrarPlatillo, JSON_UNESCAPED_UNICODE);
    }

    if($action == 'editarPlatillo'){
        $id = $_GET['id'];

        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];
        $detalles = $_POST['detalles'];


        $editarPlatillo = $crud->editarPlatillo($id,$nombre,$precio,$tipo, $detalles);
        if ($editarPlatillo)
            print json_encode($editarPlatillo, JSON_UNESCAPED_UNICODE);
    }


