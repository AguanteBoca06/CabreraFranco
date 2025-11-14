<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style\bienvenido.css">
</head>
<body>
    <h2>Bienvenido 
        <?php 
            session_start();
            echo $_SESSION['nombre'];
        ?> 🐾
    </h2>
  <div class="contenedor">
    <a href="Registros y login/control_vacunas/registro de vacuna.php" class="boton">
        <img src="Img/vacuna.jpg" alt="Vacunas">
        <span>Vacunas</span>
    </a>
    <?php//linea para ocultar el boton por tener rol cliente ?>
    <?php if ($_SESSION['rol'] === 'admin'):?>
        <a href="Registros y login/medicamentos/registro_medicamentos.html" class="boton">
            <img src="Img/medicamentos.jpg" alt="Medicamentos">
            <span>Medicamentos</span>
        </a>
    <?php endif; ?>

    <a href="clases/Animales.php" class="boton">
        <img src="Img/animales.jpg" alt="Mis Animales">
        <span>Mis animales</span>
    </a>
    
    <?php if ($_SESSION['rol'] === 'admin'):?>
    <a href="Registros y login/historia_clinica/registro_hc.html" class="boton">
        <img src="Img/historia clinica.jpg" alt="Historia Clínica">
        <span>Historia clínica</span>
    </a>
    <?php endif; ?>

    <a href="Registros y login/recordatorio/registro_recordatorio.php" class="boton">
        <img src="Img/recordatorio.jpg" alt="Recordatorio">
        <span>Recordatorio</span>
    </a>

    <a href="Registros y login/animales/registro_animales.html" class="boton">
        <img src="Img/registro animales.jpg" alt="Registrar animales">
        <span>Registrar animales</span>
    </a>
</div>
    <div id= "logout">
        <a href="Registros y login/usuarios/logout.php" class="boton"> Cerrar Sesion </a>
    </div>
    <div class="banner">
        <img src="img/logo.jpg" alt="Logo">
    </div>
</body>
</html>