<?php
    session_start();
    require_once "../../clases/Usuarios.php";
    //Sirve para validar que se este logeado
    if (!isset($_SESSION['id_usuario'])) {
        header('location: login.html');
        exit;
    }

    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $contrasenia = $_POST['contrasenia'] ?? '';

    $passwordHash = password_hash($contrasenia, PASSWORD_DEFAULT);

    $usuarios = new Usuarios ();
    $usuarios->add($nombre, $email, $passwordHash);
    exit;
?>