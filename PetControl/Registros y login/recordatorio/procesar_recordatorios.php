<?php
    require_once "../../clases/Recordatorio.php";
    //Sirve para validar que se este logeado
    if (!isset($_SESSION['id_usuario'])) {
        header('location: login.html');
        exit;
    }

    $id_usuario = $_POST['id_usuario'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    $recordatorio = new Recordatorio ();
    
    $recordatorio->add($id_usuario, $descripcion, $titulo, $fecha, $tipo);
    header("location: registro_recordatorio.html");
    exit;
?>