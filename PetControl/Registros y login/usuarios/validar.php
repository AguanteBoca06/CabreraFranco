<?php
    session_start();
    require_once "../../conexion.php";

    $email = $_POST['email'] ?? '';
    $contraseniaVerificar = $_POST['contrasenia'] ?? '';

    $db = new Database();
    $pdo = $db->connect();
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $contraseniaHash = $fila['contrasenia'];
        if (password_verify($contraseniaVerificar,$contraseniaHash)) {
            $_SESSION['id_usuario'] = $fila['id_usuario'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['rol'] = $fila['rol'];
            header("Location: ../../bienvenido.php");
            exit; 
        } else {
            echo "Usuario o contraseña incorrectos";
            header("Location: login.html");
            exit;
        }
    }
?>
