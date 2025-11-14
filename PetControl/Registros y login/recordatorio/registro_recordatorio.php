<?php
    session_start();
    if ($_SESSION['rol'] === 'cliente') {
        header('location: ../../clases/Recordatorio.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PetControl</title>
    <link rel="stylesheet" href="../../style/registrar_animal.css">
</head>
<body>
    <h2>Registrar recordatorio</h2>
    <div class="contenedor">
        <form action="procesar_recordatorios.php" method="post">
            <input type="text" name="id_usuario" placeholder="Id del usuario" required><br><br>
            <input type="text" name="descripcion" placeholder="Descripcion" required><br><br>
            <input type="text" name="titulo" placeholder="Titulo" required><br><br>
            <input type="date" name="fecha" placeholder="Fecha" required><br><br>
            <input type="text" name="tipo" placeholder="Tipo" required><br><br>
            <button type="submit">Registrar recordatorio</button>
            <p><a href="../../clases/Recordatorio.php">Ver recordatorio</a></p>
            <p><a href="../../clases/Usuarios.php">Consultar id del usuario</a></p>
        </form>
    </div>
    <div class="banner">
          <a href="../../bienvenido.php">
    <img src="../../Img/logo.jpg" alt="Logo">
</div>
</body>
</html> 