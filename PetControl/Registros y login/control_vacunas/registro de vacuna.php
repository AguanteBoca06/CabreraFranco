<?php
    session_start();
    //if para validar que sea admin, para que pueda registrar vacunas.
    if ($_SESSION['rol'] === 'cliente') {
        header('location: ../../clases/ControlVacunas.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PetControl</title>
    <link rel="stylesheet" href="../../style/registrar_vacunas.css">
</head>
<body>
    <h2>Registrar vacunas</h2>
    <div class="contenedor">
        <form action="procesar_registro_V.php" method="post">
            <input type="text" name="nombre" placeholder="Nombre" required><br><br>
            <input type="text" name="descripcion" placeholder="Descripcion" required><br><br>
            <button type="submit">Registrar vacuna</button>
        </form>
        <form action="procesar_registro_V.php" method="post">
            <input type="text" name="id_animal" placeholder="Id del animal" required><br><br>
            <input type="text" name="id_vacuna" placeholder="Id de la vacuna" required><br><br>
            <input type="date" name="fecha" placeholder="Fecha" required><br><br>
            <input type="text" name="dosis" placeholder="Dosis" required><br><br>
            <input type="text" name="veterinario" placeholder="Veterinario" required><br><br>
            <button type="submit">Registrar vacuna puesta</button>
        </form>
    </div>
    <p>
        <a href="../../clases/ControlVacunas.php">Ver control de vacunas</a>
        <a href="../../clases/Animales.php">Consultar id del animal</a>
    </p>
    <div class="banner">
        <a href="../../bienvenido.php"> 
        <img src="../../Img/logo.jpg" alt="Logo">
    </div>
</body>
</html> 