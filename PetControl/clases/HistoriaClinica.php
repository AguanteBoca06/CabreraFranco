<?php
    session_start();
    require_once __DIR__ . "/../conexion.php";
    
    class HistoriaClinica {
        private $db;
        
        public function __construct() {
            $this->db = (new Database())->connect();
        }
        
        public function getAll() {        
            $sql = "SELECT 
                HC.fecha,
                HC.diagnostico, 
                HC.observaciones, 
                A.nombre AS nombre_animal
                FROM historiaclinica HC
                JOIN animal A ON HC.id_animal = A.id_animal";          
            $stmt = $this->db->prepare($sql);        
            $stmt->execute(); 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);    
        }

        public function add($id_animal, $fecha, $diagnostico, $observaciones) {
            $sql = "INSERT INTO historiaclinica (id_animal, fecha, diagnostico, observaciones) VALUES (:id_animal, :fecha, :diagnostico, :observaciones)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_animal' => $id_animal, ':fecha' => $fecha, ':diagnostico' =>$diagnostico, ':observaciones' =>$observaciones]);
        }
    }

    $historiaclinica = new HistoriaClinica ();
    $lista_historiaclinica = [];
    $lista_historiaclinica = $historiaclinica->getAll();
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
        <h2>Historia clinica</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del animal</th>
                        <th>Fecha</th>
                        <th>Diagnostico</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_historiaclinica as $hc): ?>
                    <tr>
                        <td><?php echo ($hc['nombre_animal']);?></td>
                        <td><?php echo ($hc['fecha']);?></td>
                        <td><?php echo ($hc['diagnostico']);?></td>   
                        <td><?php echo ($hc['observaciones']);?></td>          
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>