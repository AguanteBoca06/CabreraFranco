<?php
    require_once __DIR__ . "/../conexion.php";
    
    class Usuarios {
        private $db;

        public function __construct() {
            $this->db = (new Database())->connect();
        }
        //agrege el rol
        public function add($nombre, $email, $contrasenia) {
            $rol = 'cliente';
            $sql = "INSERT INTO usuarios (nombre, email, contrasenia, rol) VALUES (:nombre, :email, :contrasenia, :rol)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':nombre' => $nombre, ':email' => $email, ':contrasenia' => $contrasenia, ':rol'=>$rol]);
        }
        
        public function getAll(){
            $sql = "SELECT id_usuario, nombre, email, contrasenia, rol FROM usuarios";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    $usuario = new Usuarios();
    $lista_usuarios = [];
    $lista_usuarios = $usuario->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuarios</title>
    <link rel="stylesheet" href="../style/animales.css"> 
</head>
<html>
    <body>
        <h2>Usuarios</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_usuarios as $usuarios): ?>
                    <tr>
                        <td><?php echo ($usuarios['id_usuario']);?></td>
                        <td><?php echo ($usuarios['nombre']);?></td>
                        <td><?php echo ($usuarios['email']);?></td>    
                        <td><?php echo ($usuarios['rol']);?></td>     
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>      
    </body>
</html>