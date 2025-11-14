<?php
    session_start();
    require_once __DIR__ . "/../conexion.php";
    
    class Medicamentos {
        private $db;

        public function __construct() {
            $this->db = (new Database())->connect();
        }

        public function add($nombre, $descripcion, $presentacion) {
            $sql = "INSERT INTO medicamento (nombre, descripcion, presentacion) VALUES (:nombre, :descripcion, :presentacion)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':nombre' => $nombre, ':descripcion' => $descripcion, ':presentacion' => $presentacion]);
        }
        
        public function getAll(){
            $sql = "SELECT nombre, descripcion, presentacion FROM medicamento";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $medicamento = new Medicamentos ();
    $lista_medicamento = [];
    $lista_medicamento = $medicamento->getAll();
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
        <h2>Medicamentos</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Presentacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_medicamento as $medicamentos): ?>
                    <tr>
                        <td><?php echo ($medicamentos['nombre']);?></td>
                        <td><?php echo ($medicamentos['descripcion']);?></td>    
                        <td><?php echo ($medicamentos['presentacion']);?></td>     
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>      
    </body>
</html>