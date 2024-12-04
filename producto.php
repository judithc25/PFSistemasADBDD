<?php
require_once 'src/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
     
    if (!$nombre || !$cantidad || !$precio || !$fecha_vencimiento || !$fecha_ingreso) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            
            $sql = "INSERT INTO productos (nombre, cantidad, precio, fecha_vencimiento, fecha_ingreso) 
                    VALUES (:nombre, :cantidad, :precio, :fecha_vencimiento, :fecha_ingreso)";
            $stmt = $conn->prepare($sql);

            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);

            
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
