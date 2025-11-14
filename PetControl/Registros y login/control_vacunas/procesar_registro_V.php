<?php
    require_once "../../clases/ControlVacunas.php";
    //Sirve para validar que se este logeado
    if (!isset($_SESSION['id_usuario'])) {
        header('location: login.html');
        exit;
    }

    //registro vacuna simple
    if (!empty($_POST['nombre']) && !empty($_POST['descripcion'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        
        $vacunas = new ControlVacunas();
        $vacunas->addVacunas($nombre, $descripcion);

        header('Location: registro de vacuna.php');
        exit;
    } elseif (!empty($_POST['id_animal']) && !empty($_POST['id_vacuna'])) {
        // este es el formulario completo
        $id_animal = $_POST['id_animal'];
        $id_vacuna = $_POST['id_vacuna'];
        $fecha = $_POST['fecha'];
        $dosis = $_POST['dosis'];
        $veterinario = $_POST['veterinario'];

        $vacunas = new ControlVacunas();
        $vacunas->addControlVacunas($id_animal, $id_vacuna, $fecha, $dosis, $veterinario);
        
        
        header('Location: registro de vacuna.php');
        exit;
    }
?> 