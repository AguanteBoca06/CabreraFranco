<?php
    session_start();
    require_once __DIR__ . "/../conexion.php";
    
    class ControlVacunas {
        private $db;

        public function __construct() {
            $this->db = (new Database())->connect();
        }

        public function addControlVacunas($id_animal, $id_vacuna, $fecha, $dosis, $veterinario) {
            $sql = "INSERT INTO controlvacuna (id_animal, id_vacuna, fecha, dosis, veterinario) VALUES (:id_animal, :id_vacuna, :fecha, :dosis, :veterinario)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_animal' => $id_animal, ':id_vacuna' => $id_vacuna, ':fecha' =>$fecha, ':dosis' =>$dosis, ':veterinario' =>$veterinario]);
        }

        public function addVacunas($nombre, $descripcion) {
            $sql = "INSERT INTO vacuna (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':nombre' => $nombre, ':descripcion' => $descripcion]);
        }
        
        public function getAll() {        
            $sql = "SELECT a.nombre AS nombre_animal, 
                v.nombre AS nombre_vacuna,
                cv.fecha,
                cv.dosis,
                cv.veterinario
                FROM controlvacuna AS cv
                JOIN animal AS a ON cv.id_animal = a.id_animal
                JOIN vacuna AS v ON cv.id_vacuna = v.id_vacuna;";          
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);    
        }

        public function control_de_vacunas_del_cliente($id_usuario){
            $sql = "SELECT a.nombre AS nombre_animal, 
                v.nombre AS nombre_vacuna,
                cv.fecha,
                cv.dosis,
                cv.veterinario
                FROM controlvacuna AS cv 
                JOIN animal AS a ON cv.id_animal = a.id_animal
                JOIN vacuna AS v ON cv.id_vacuna = v.id_vacuna
                WHERE a.id_usuario = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_usuario' =>$id_usuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function tablaVacunas(){
            $sql = "SELECT id_vacuna, nombre, descripcion FROM vacuna";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $vacuna = new ControlVacunas ();
    $lista_control_vacunas = [];
    $lista_vacunas = $vacuna -> tablaVacunas();
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        $lista_control_vacunas = $vacuna->getAll();
    } elseif (isset($_SESSION['id_usuario']) && $_SESSION['rol'] === 'cliente') {
        $id_usuario = $_SESSION['id_usuario'];
        $lista_control_vacunas = $vacuna->control_de_vacunas_del_cliente($id_usuario);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Animales</title>
    <link rel="stylesheet" href="../style/animales.css">
</head>
<html>
    <body>
        <?php if ($_SESSION['rol'] === 'admin'):?>
        <h2>Vacunas</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_vacunas as $vacunas): ?>
                    <tr>
                        <td><?php echo ($vacunas['id_vacuna']);?></td>
                        <td><?php echo ($vacunas['nombre']);?></td>
                        <td><?php echo ($vacunas['descripcion']);?></td>         
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>       

        <h2>Control de vacunas</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre de animal</th>
                        <th>Nombre de vacuna</th>
                        <th>Fecha</th>
                        <th>Dosis</th>
                        <th>Veterinario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_control_vacunas as $lista_cv): ?>
                    <tr>
                        <td><?php echo ($lista_cv['nombre_animal']);?></td>
                        <td><?php echo ($lista_cv['nombre_vacuna']);?></td>
                        <td><?php echo ($lista_cv['fecha']);?></td>
                        <td><?php echo ($lista_cv['dosis']);?></td>   
                        <td><?php echo ($lista_cv['veterinario']);?></td>             
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>