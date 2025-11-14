<?php
    session_start();
    require_once __DIR__ . "/../conexion.php";
    
    class Animales {
        private $db;

        public function __construct() {
            $this->db = (new Database())->connect();
        }
        //funcion para mostrar todos los animales
        public function getAll() {        
            $sql = "SELECT 
                A.id_animal,
                A.nombre AS nombre_animal, 
                A.especie, 
                A.raza, 
                A.fecha_nacimiento,
                U.nombre AS nombre_duenio,
                U.id_usuario
                FROM animal A
                JOIN usuarios U ON A.id_usuario = U.id_usuario";          
            $stmt = $this->db->query($sql);        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);    
        }

        //funcion para mostrar al de rol cliente solo sus animales.
        public function animales_del_cliente($id_usuario){
            $sql = "SELECT A.id_animal, A.nombre AS nombre_animal, A.especie, A.raza, A.fecha_nacimiento, U.nombre AS nombre_duenio
                FROM animal A 
                JOIN usuarios U ON A.id_usuario = U.id_usuario
                WHERE A.id_usuario = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_usuario' =>$id_usuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function add($nombre, $especie, $raza, $fecha_nacimiento, $id_usuario) {
            $sql = "INSERT INTO animal (nombre, especie, raza, fecha_nacimiento, id_usuario) VALUES (:nombre, :especie, :raza, :fecha_nacimiento, :id_usuario)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':nombre' => $nombre, ':especie' => $especie, ':raza' =>$raza, ':fecha_nacimiento' =>$fecha_nacimiento, ':id_usuario' =>$id_usuario]);
        }
    }

    $animal = new Animales ();
    $lista_animales = [];
    //sentencia para diferenciar los roles y saber que mostrar.
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        $lista_animales = $animal->getAll();
    } elseif (isset($_SESSION['id_usuario']) && $_SESSION['rol'] === 'cliente') {
        $id_usuario = $_SESSION['id_usuario'];
        $lista_animales = $animal->animales_del_cliente($id_usuario);
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
        <h2>Animales</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Fecha de nacimineto</th>
                        <th>Dueño</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_animales as $animales): ?>
                    <tr>
                        <td><?php echo ($animales['id_animal']);?></td>
                        <td><?php echo ($animales['nombre_animal']);?></td>
                        <td><?php echo ($animales['especie']);?></td>   
                        <td><?php echo ($animales['raza']);?></td>    
                        <td><?php echo ($animales['fecha_nacimiento']);?></td>    
                        <td><?php echo ($animales['nombre_duenio']);?></td>      
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>