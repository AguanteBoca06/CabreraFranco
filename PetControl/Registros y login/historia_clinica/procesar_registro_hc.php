<?php
    require_once "../../clases/HistoriaClinica.php";
    //Sirve para validar que se este logeado
    if (!isset($_SESSION['id_usuario'])) {
        header('location: login.html');
        exit;
    }
    $id_animal = $_POST['id_animal'];
    $fecha = $_POST['fecha'];
    $diagnostico = $_POST['diagnostico'];
    $observaciones = $_POST['observaciones'];
        
    $historiaclinica = new HistoriaClinica();
    $historiaclinica->add($id_animal, $fecha, $diagnostico, $observaciones);

    header('Location: registro_hc.html');
    exit;
?> 