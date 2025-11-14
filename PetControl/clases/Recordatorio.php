<?php 
    session_start();
    require_once __DIR__ . "/../conexion.php";

    class Recordatorio {
        private $db;

        public function __construct() {
            $this->db = (new Database())->connect();
        }

        public function add($id_usuario, $descripcion, $titulo, $fecha, $tipo) {
            $sql = "INSERT INTO recordatorio (id_usuario, descripcion, titulo, fecha, tipo) VALUES (:id_usuario, :descripcion, :titulo, :fecha, :tipo)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario, ':descripcion' => $descripcion, ':titulo' => $titulo, ':fecha'=> $fecha, ':tipo' =>$tipo ]);
        }    
        
        
        public function getAll(){
            $sql = "SELECT R.descripcion, 
                R.titulo, 
                R.fecha, 
                R.tipo,
                U.nombre as nombre_usuario
                FROM recordatorio R
                JOIN usuarios U ON R.id_usuario = U.id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function recordatorios_del_cliente($id_usuario){
            $sql = "SELECT R.titulo, 
                R.fecha, 
                R.tipo,
                R.descripcion,
                U.nombre AS nombre_usuario
                FROM recordatorio R 
                JOIN usuarios U ON R.id_usuario = U.id_usuario
                WHERE R.id_usuario = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_usuario' =>$id_usuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $recordatorio = new Recordatorio();
    $lista_recordatorio = [];
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        $lista_recordatorio = $recordatorio->getAll();
    } elseif (isset($_SESSION['id_usuario']) && $_SESSION['rol'] === 'cliente') {
        $id_usuario = $_SESSION['id_usuario'];
        $lista_recordatorio = $recordatorio->recordatorios_del_cliente($id_usuario);
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Recordatorios</title>
    <link rel="stylesheet" href="../style/animales.css"> 
</head>
<html>
    <body>
        <h2>Recordatorios</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Titulo</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_recordatorio as $recordatorio): ?>
                    <tr>
                        <td><?php echo ($recordatorio['nombre_usuario']);?></td>
                        <td><?php echo ($recordatorio['descripcion']);?></td>    
                        <td><?php echo ($recordatorio['titulo']);?></td>
                        <td><?php echo ($recordatorio['fecha']);?></td>
                        <td><?php echo ($recordatorio['tipo']);?></td>     
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>      
    </body>
</html>