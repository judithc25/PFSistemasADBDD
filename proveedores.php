<?php
require_once 'src/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $numero_cuenta = $_POST['numero_cuenta'];
     
    if (!$nombre || !$direccion || !$telefono || !$numero_cuenta) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            
            $sql = "INSERT INTO proveedores (nombre, direccion, telefono, numero_cuenta) 
                    VALUES (:nombre, :direccion, :telefono, :numero_cuenta)";
            $stmt = $conn->prepare($sql);

            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':numero_cuenta', $numero_cuenta);

            
            if ($stmt->execute()) {
                echo 'Registro exitoso.';
            } else {
                echo 'Hubo un error al registrar los datos.';
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
