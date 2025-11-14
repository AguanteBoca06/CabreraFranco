<?php
    require_once "../../clases/Medicamentos.php";
    //Sirve para validar que se este logeado
    if (!isset($_SESSION['id_usuario'])) {
        header('location: login.html');
        exit;
    }

    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $presentacion = $_POST['presentacion'] ?? '';

    $medicamento = new Medicamentos ();
    
    $medicamento->add($nombre, $descripcion, $presentacion);
    header("location: registro_medicamentos.html");
    exit;
?>