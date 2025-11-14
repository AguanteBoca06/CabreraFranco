<?php
    session_start();
    require_once "../../clases/Animales.php";
    //Sirve para validar que se este logeado
    if (!isset($_SESSION['id_usuario'])) {
        header('location: login.html');
        exit;
    }
    /*se puede probar haciando un if que si es el rol es admin te de la opcion de cargar animales 
    a un cliente preguntando nombre y gmail para identificarlo y saber a cual se va a registrar el 
    animal. Luego de eso se haria lo mismo que en el resto del codigo. pero si es rol cliente se usaria 
    nomas el id de session para registrar un animal a ese id.*/
    $nombre = $_POST['nombre'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $raza = $_POST['raza'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $id_usuario = $_SESSION['id_usuario'] ?? '';

    $animales = new Animales ();
    
    $animales->add($nombre, $especie, $raza, $fecha_nacimiento, $id_usuario);
    header("location: registro_animales.html");
    exit;
?>