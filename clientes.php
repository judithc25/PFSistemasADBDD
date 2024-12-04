<?php
require_once 'src/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    
    
    if (!$nombre || !$telefono || !$direccion) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }

    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            $sql = "INSERT INTO clientes (nombre, telefono, direccion)
                    VALUES (:nombre, :telefono, :direccion)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);

          
            if ($stmt->execute()) {
                echo 'Cliente registrado con éxito.';
            } else {
                echo 'Hubo un error al registrar el cliente.';
            }
        } catch (PDOException $e) {
            echo 'Error en la base de datos: ' . $e->getMessage();
        }
    } else {
        echo 'No se pudo conectar a la base de datos.';
    }
} else {
    echo 'Método no permitido.';
}
?>
